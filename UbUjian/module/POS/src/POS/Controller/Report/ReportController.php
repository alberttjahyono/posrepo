<?php
namespace POS\Controller\Report;

use POS\Model\Entity\Transaksi;
use PHPExcel;
use mPDF;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Session\Container;

class ReportController extends AbstractActionController {

	public function reportAction() {		
		$namaUser = $this->authPlugin()->getLoginData();
		$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
		$Transaksi = new Transaksi();
		$queryBuilder = $objectManager -> createQueryBuilder()
			->select('u')
			->from('POS\Model\Entity\Transaksi', 'u')
			->orderBy('u.ID_TRANSAKSI', 'ASC');
		$query = $queryBuilder -> getQuery();
		$allTransaksi = $query -> getResult();
		$reportData = array();

		foreach ($allTransaksi as $myTransaksi) {
			$detailRepository = $objectManager -> getRepository('POS\Model\Entity\DetailTransaksi');
			$detailTransaksi = $detailRepository -> findBy(array('ID_TRANSAKSI' => $myTransaksi -> getIdTransaksi()));
			$arrayDetail = array();
			foreach ($detailTransaksi as $dTransaksi) {
				$barangRepository = $objectManager -> getRepository('POS\Model\Entity\Barang');
				$Barang = $barangRepository -> findBy(array('ID_BARANG' => $dTransaksi -> getIdBarang()));
				foreach ($Barang as $myBarang) {
					$namaBarang = $myBarang -> getNama();
					array_push($arrayDetail, array(
						'namaBarang' => $namaBarang, 
						'jumlah' => $dTransaksi -> getJumlah(), 
						'harga' => $dTransaksi -> getHarga(), 
						'total' => $dTransaksi -> getJumlah() * $dTransaksi -> getHarga()
					));
				}
			}
			$dataTransaksi = array(
				'idTransaksi'=>$myTransaksi -> getIdTransaksi(),
				'tglTransaksi'=>$myTransaksi->getTanggal(),
				'user'=>$myTransaksi->getUser(),
				'total'=>$myTransaksi->getTotal()
			);
			array_push($reportData, array('transaksiData' => $dataTransaksi, 'detailTransaksi' => $arrayDetail));
		}
		$reportSession = new Container('report');
		$reportSession->reportData = $reportData;
		return array('messages'=>$this->flashmessenger(),'namaUser'=>$namaUser,'reportData'=>$reportData);

	}
	public function pdfAction() {
		$reportSession = new Container('report');
		$reportData = $reportSession->reportData;
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$rendererName = \PHPExcel_Settings::PDF_RENDERER_MPDF;
		$rendererLibrary = 'MPDF57';
		$rendererLibraryPath = getcwd().'/vendor/' . $rendererLibrary;
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getProperties()->setCreator("Albert Tjahyono")
									 ->setLastModifiedBy("Albert Tjahyono")
									 ->setTitle("Report Pembelian")
									 ->setSubject("Report Pembelian")
									 ->setDescription("Report Pembelian, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Report Pembelian");
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "Id Transaksi");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "Tanggal");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "User");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "Total Transaksi");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "Detail Transaksi");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "Nama Barang");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "Jumlah Barang");
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "Harga Barang");
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "Subtotal");
			
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);
		
		
		// Add data
		$worksheet = $objPHPExcel->getActiveSheet();
		$rowID=2;
		
		
		foreach($reportData as $row => $columns) {
			$columnId = 'A';
			
			foreach($columns['transaksiData'] as $column => $data) {
		        $worksheet->setCellValue($columnId.($rowID), $data);
				$columnId++;
		    }
		    
			foreach($columns['detailTransaksi'] as $column => $data) {
				$myColumn = $columnId;
				$worksheet->setCellValue($myColumn.($rowID), $reportData[$row]['transaksiData']['idTransaksi']);
				$myColumn++;
				foreach($data as $detail => $dataDetail) {
			        $worksheet->setCellValue($myColumn.($rowID), $dataDetail);
					$myColumn++;
					
		    	}	
				$rowID++;			
		    }
		}
		
		foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
        $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
    	} 
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		if (!\PHPExcel_Settings::setPdfRenderer(
			$rendererName,
			$rendererLibraryPath
		)) {
			die(
				'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
				'<br />' .
				'at the top of this script as appropriate for your directory structure'
			);
		}
				
		
		

		// Redirect output to a clientâ€™s web browser (Excel2007)
		header('application/pdf');
		header('Content-Disposition: attachment;filename="report.PDF"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter =\ PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
		$objWriter->save('php://output');

		return $this->redirect()->toRoute('report');
	}
	public function excelAction() {
		$reportSession = new Container('report');
		$reportData = $reportSession->reportData;
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getProperties()->setCreator("Albert Tjahyono")
									 ->setLastModifiedBy("Albert Tjahyono")
									 ->setTitle("Report Pembelian")
									 ->setSubject("Report Pembelian")
									 ->setDescription("Report Pembelian, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Report Pembelian");
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "Id Transaksi");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "Tanggal");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "User");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "Total Transaksi");
		$objPHPExcel->getActiveSheet()->setCellValue('E1', "Detail Transaksi");
		$objPHPExcel->getActiveSheet()->setCellValue('F1', "Nama Barang");
		$objPHPExcel->getActiveSheet()->setCellValue('G1', "Jumlah Barang");
		$objPHPExcel->getActiveSheet()->setCellValue('H1', "Harga Barang");
		$objPHPExcel->getActiveSheet()->setCellValue('I1', "Subtotal");
			
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);
		
		
		// Add data
		$worksheet = $objPHPExcel->getActiveSheet();
		$rowID=2;
		
		
		foreach($reportData as $row => $columns) {
			$columnId = 'A';
			
			foreach($columns['transaksiData'] as $column => $data) {
		        $worksheet->setCellValue($columnId.($rowID), $data);
				$columnId++;
		    }
		    
			foreach($columns['detailTransaksi'] as $column => $data) {
				$myColumn = $columnId;
				$worksheet->setCellValue($myColumn.($rowID), $reportData[$row]['transaksiData']['idTransaksi']);
				$myColumn++;
				foreach($data as $detail => $dataDetail) {
			        $worksheet->setCellValue($myColumn.($rowID), $dataDetail);
					$myColumn++;
					
		    	}	
				$rowID++;			
		    }
		}
		
		foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
        $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
    	} 
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		

		// Redirect output to a clientâ€™s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="report.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter =\ PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

		return $this->redirect()->toRoute('report');
	}

	public function chartAction() {	
		$reportSession = new Container('report');
		$reportData = $reportSession->reportData;
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Albert Tjahyono")
									 ->setLastModifiedBy("Albert Tjahyono")
									 ->setTitle("Report Pembelian")
									 ->setSubject("Report Pembelian")
									 ->setDescription("Report Pembelian, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Report Pembelian");
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', "Id Transaksi");
		$objPHPExcel->getActiveSheet()->setCellValue('B1', "Tanggal");
		$objPHPExcel->getActiveSheet()->setCellValue('C1', "User");
		$objPHPExcel->getActiveSheet()->setCellValue('D1', "Total Transaksi");
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);
		$worksheet = $objPHPExcel->getActiveSheet();
		$rowID=2;
		$chartArray = array();
		foreach($reportData as $row => $columns) {
			$columnId = 'A';			
			foreach($columns['transaksiData'] as $column => $data) {
		        $worksheet->setCellValue($columnId.($rowID), $data);
				$columnId++;
		    }
		    array_push($chartArray, new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$'.$rowID, NULL, $rowID-1));
			$xAxisTickValues = array(
				new \PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$'.$rowID, NULL, $rowID-1),
			);			
			$dataSeriesValues = array(
			    new \PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$'.$rowID, NULL, $rowID-1),
			);
		    $rowID++;	
		}		
		$series = new \PHPExcel_Chart_DataSeries(
			\PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
			\PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
			range(0, count($dataSeriesValues)-1),			// plotOrder
			$chartArray,								// plotLabel
			$xAxisTickValues,								// plotCategory
			$dataSeriesValues								// plotValues
		);
		$series->setPlotDirection(\PHPExcel_Chart_DataSeries::DIRECTION_BAR);
		$plotarea = new \PHPExcel_Chart_PlotArea(NULL, array($series));
		$legend = new \PHPExcel_Chart_Legend(\PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
		$title = new \PHPExcel_Chart_Title('Chart Total Pembelian Per Transaksi');
		$yAxisLabel = new \PHPExcel_Chart_Title('Total Pembelian');
		$chart = new \PHPExcel_Chart(
			'chart1',		// name
			$title,			// title
			$legend,		// legend
			$plotarea,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			$yAxisLabel		// yAxisLabel
		);
		$chart->setTopLeftPosition('F1');
		$chart->setBottomRightPosition('Q'.($rowID+10));
		$objWorksheet =  $objPHPExcel->getActiveSheet();
		//	Add the chart to the worksheet
		$objWorksheet->addChart($chart);

		foreach (range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
        $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
    	} 
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Redirect output to a clientâ€™s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="report.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');

		return $this->redirect()->toRoute('report');
	}
}
?>