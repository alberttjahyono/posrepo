--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.userpos DROP CONSTRAINT userpos_pkey;
ALTER TABLE ONLY public.transaksi DROP CONSTRAINT transaksi_pkey;
ALTER TABLE ONLY public.detailtransaksi DROP CONSTRAINT detailtransaksi_pkey;
ALTER TABLE ONLY public.barang DROP CONSTRAINT barang_pkey;
ALTER TABLE public.userpos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.transaksi ALTER COLUMN id_transaksi DROP DEFAULT;
ALTER TABLE public.detailtransaksi ALTER COLUMN id_detail DROP DEFAULT;
ALTER TABLE public.barang ALTER COLUMN id_barang DROP DEFAULT;
DROP SEQUENCE public.userpos_id_seq;
DROP TABLE public.userpos;
DROP SEQUENCE public.transaksi_id_transaksi_seq;
DROP TABLE public.transaksi;
DROP SEQUENCE public.detailtransaksi_id_detail_seq;
DROP TABLE public.detailtransaksi;
DROP SEQUENCE public.barang_id_barang_seq;
DROP TABLE public.barang;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: barang; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE barang (
    id_barang integer NOT NULL,
    nama character varying(50) NOT NULL,
    stok integer NOT NULL,
    harga_beli integer NOT NULL,
    harga_jual integer NOT NULL,
    status character varying(50) NOT NULL
);


ALTER TABLE public.barang OWNER TO postgres;

--
-- Name: barang_id_barang_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE barang_id_barang_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.barang_id_barang_seq OWNER TO postgres;

--
-- Name: barang_id_barang_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE barang_id_barang_seq OWNED BY barang.id_barang;


--
-- Name: detailtransaksi; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE detailtransaksi (
    id_detail integer NOT NULL,
    id_transaksi integer NOT NULL,
    id_barang integer NOT NULL,
    jumlah integer NOT NULL,
    harga integer NOT NULL
);


ALTER TABLE public.detailtransaksi OWNER TO postgres;

--
-- Name: detailtransaksi_id_detail_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE detailtransaksi_id_detail_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.detailtransaksi_id_detail_seq OWNER TO postgres;

--
-- Name: detailtransaksi_id_detail_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE detailtransaksi_id_detail_seq OWNED BY detailtransaksi.id_detail;


--
-- Name: transaksi; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE transaksi (
    id_transaksi integer NOT NULL,
    namauser character varying(50) NOT NULL,
    tgltransaksi timestamp without time zone DEFAULT now(),
    total integer NOT NULL
);


ALTER TABLE public.transaksi OWNER TO postgres;

--
-- Name: transaksi_id_transaksi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE transaksi_id_transaksi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.transaksi_id_transaksi_seq OWNER TO postgres;

--
-- Name: transaksi_id_transaksi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE transaksi_id_transaksi_seq OWNED BY transaksi.id_transaksi;


--
-- Name: userpos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE userpos (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(50) NOT NULL
);


ALTER TABLE public.userpos OWNER TO postgres;

--
-- Name: userpos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE userpos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.userpos_id_seq OWNER TO postgres;

--
-- Name: userpos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE userpos_id_seq OWNED BY userpos.id;


--
-- Name: id_barang; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY barang ALTER COLUMN id_barang SET DEFAULT nextval('barang_id_barang_seq'::regclass);


--
-- Name: id_detail; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY detailtransaksi ALTER COLUMN id_detail SET DEFAULT nextval('detailtransaksi_id_detail_seq'::regclass);


--
-- Name: id_transaksi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transaksi ALTER COLUMN id_transaksi SET DEFAULT nextval('transaksi_id_transaksi_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY userpos ALTER COLUMN id SET DEFAULT nextval('userpos_id_seq'::regclass);


--
-- Data for Name: barang; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO barang VALUES (7, 'Monster', 10, 15000, 15500, 'Launch');
INSERT INTO barang VALUES (9, 'Nescafe Kopi Mocha', 5, 8000, 8500, 'Launch');
INSERT INTO barang VALUES (6, 'Nescafe Original', 10, 7000, 7500, 'Standby');
INSERT INTO barang VALUES (11, 'Mizone', 30, 4000, 4500, 'Launch');
INSERT INTO barang VALUES (3, 'Fanta', 24, 4000, 4500, 'Launch');
INSERT INTO barang VALUES (1, 'Coca Cola', 8, 4000, 4500, 'Launch');
INSERT INTO barang VALUES (10, 'Pocari Sweat', 52, 5500, 6000, 'Launch');
INSERT INTO barang VALUES (2, 'Sprite', 14, 4000, 4700, 'Launch');
INSERT INTO barang VALUES (8, 'Nescafe Kopi Susu', 35, 8000, 8500, 'Launch');
INSERT INTO barang VALUES (5, 'Kratingdaeng', 60, 4500, 5000, 'Launch');
INSERT INTO barang VALUES (4, 'Kopiko', 13, 6900, 7900, 'Launch');
INSERT INTO barang VALUES (12, 'Heineken', 10, 23000, 23500, 'Launch');


--
-- Name: barang_id_barang_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('barang_id_barang_seq', 12, true);


--
-- Data for Name: detailtransaksi; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO detailtransaksi VALUES (1, 1, 1, 5, 4000);
INSERT INTO detailtransaksi VALUES (2, 2, 2, 10, 4000);
INSERT INTO detailtransaksi VALUES (3, 3, 3, 20, 4000);
INSERT INTO detailtransaksi VALUES (4, 4, 4, 10, 6700);
INSERT INTO detailtransaksi VALUES (5, 5, 5, 40, 4500);
INSERT INTO detailtransaksi VALUES (6, 6, 6, 10, 7000);
INSERT INTO detailtransaksi VALUES (7, 7, 7, 10, 15000);
INSERT INTO detailtransaksi VALUES (8, 8, 8, 5, 8000);
INSERT INTO detailtransaksi VALUES (9, 9, 9, 5, 8000);
INSERT INTO detailtransaksi VALUES (10, 10, 10, 50, 5500);
INSERT INTO detailtransaksi VALUES (11, 11, 11, 30, 4000);
INSERT INTO detailtransaksi VALUES (12, 12, 3, 4, 4000);
INSERT INTO detailtransaksi VALUES (13, 12, 1, 3, 4000);
INSERT INTO detailtransaksi VALUES (14, 12, 10, 2, 5500);
INSERT INTO detailtransaksi VALUES (15, 12, 4, 3, 6700);
INSERT INTO detailtransaksi VALUES (16, 12, 2, 4, 4000);
INSERT INTO detailtransaksi VALUES (17, 13, 8, 30, 8000);
INSERT INTO detailtransaksi VALUES (18, 13, 5, 20, 4500);
INSERT INTO detailtransaksi VALUES (19, 14, 8, 6, 8000);
INSERT INTO detailtransaksi VALUES (20, 14, 9, 3, 8000);
INSERT INTO detailtransaksi VALUES (21, 14, 1, 2, 4000);
INSERT INTO detailtransaksi VALUES (22, 14, 3, 1, 4000);
INSERT INTO detailtransaksi VALUES (23, 15, 12, 10, 23000);


--
-- Name: detailtransaksi_id_detail_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('detailtransaksi_id_detail_seq', 23, true);


--
-- Data for Name: transaksi; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO transaksi VALUES (1, 'antonius', '2014-07-16 10:49:42', 20000);
INSERT INTO transaksi VALUES (2, 'antonius', '2014-07-16 10:49:53', 40000);
INSERT INTO transaksi VALUES (3, 'antonius', '2014-07-16 10:50:09', 80000);
INSERT INTO transaksi VALUES (4, 'albert', '2014-07-16 10:50:27', 67000);
INSERT INTO transaksi VALUES (5, 'albert', '2014-07-16 10:50:41', 180000);
INSERT INTO transaksi VALUES (6, 'albert', '2014-07-16 10:50:54', 70000);
INSERT INTO transaksi VALUES (7, 'albert', '2014-07-16 10:51:16', 150000);
INSERT INTO transaksi VALUES (8, 'albert', '2014-07-16 10:51:28', 40000);
INSERT INTO transaksi VALUES (9, 'albert', '2014-07-16 10:51:42', 40000);
INSERT INTO transaksi VALUES (10, 'albert', '2014-07-16 10:51:56', 275000);
INSERT INTO transaksi VALUES (11, 'albert', '2014-07-16 10:52:26', 120000);
INSERT INTO transaksi VALUES (12, 'albert', '2014-07-16 10:53:10', 75100);
INSERT INTO transaksi VALUES (13, 'albert', '2014-07-16 10:55:56', 330000);
INSERT INTO transaksi VALUES (14, 'albert', '2014-07-16 11:27:33', 84000);
INSERT INTO transaksi VALUES (15, 'albert', '2014-07-16 11:33:57', 230000);


--
-- Name: transaksi_id_transaksi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('transaksi_id_transaksi_seq', 15, true);


--
-- Data for Name: userpos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO userpos VALUES (1, 'albert', 'tjahyono');
INSERT INTO userpos VALUES (2, 'antonius', 'henry');


--
-- Name: userpos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('userpos_id_seq', 1, false);


--
-- Name: barang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY barang
    ADD CONSTRAINT barang_pkey PRIMARY KEY (id_barang);


--
-- Name: detailtransaksi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY detailtransaksi
    ADD CONSTRAINT detailtransaksi_pkey PRIMARY KEY (id_detail);


--
-- Name: transaksi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY transaksi
    ADD CONSTRAINT transaksi_pkey PRIMARY KEY (id_transaksi);


--
-- Name: userpos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY userpos
    ADD CONSTRAINT userpos_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

