-- MySQL dump 10.13  Distrib 5.7.23, for osx10.9 (x86_64)
--
-- Host: z37udk8g6jiaqcbx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com    Database: g5crsqfo5qasf1et
-- ------------------------------------------------------
-- Server version	5.7.23-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup
--

SET @@GLOBAL.GTID_PURGED='';

--
-- Table structure for table `enum_mappings`
--

DROP TABLE IF EXISTS `enum_mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enum_mappings` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `form_table_id` smallint(6) DEFAULT NULL,
  `form_field_name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2847 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enum_mappings`
--

LOCK TABLES `enum_mappings` WRITE;
/*!40000 ALTER TABLE `enum_mappings` DISABLE KEYS */;
INSERT INTO `enum_mappings` VALUES (2,1492,'multiple_checkboxes','Option one'),(12,1492,'multiple_checkboxes','Option two'),(22,1492,'multiple_radios','Option one'),(32,1492,'multiple_radios','Option two'),(42,1522,'multiple_radios','Option one'),(52,1522,'multiple_radios','Option two'),(72,1492,'multiple_checkboxes','12'),(82,1542,'multiple_checkboxes','Option one'),(92,1542,'multiple_checkboxes','Option two'),(102,1542,'multiple_checkboxes','option three'),(112,1562,'multiple_radios','Option one'),(122,1562,'multiple_radios','Option two'),(132,1592,'multiple_radios','Option one'),(142,1592,'multiple_radios','Option two'),(172,1592,'multiple_checkboxes','chicken'),(182,1592,'multiple_checkboxes','beef'),(192,1592,'multiple_checkboxes','pork'),(222,1592,'multiple_checkboxes',''),(232,1602,'multiple_radios','Option one'),(242,1602,'multiple_radios','Option two'),(252,1632,'multiple_checkboxes','Option one'),(262,1632,'multiple_checkboxes','Option two'),(272,1632,'multiple_checkboxes_1','Option one'),(282,1632,'multiple_checkboxes_1','Option two'),(292,1622,'multiple_checkboxes','Option one'),(302,1622,'multiple_checkboxes','Option two'),(312,1662,'multiple_checkboxes','Option one'),(322,1662,'multiple_checkboxes','Option two'),(332,1702,'multiple_checkboxes','Option one'),(342,1702,'multiple_checkboxes','Option two'),(382,1762,'multiple_checkboxes','beef'),(392,1762,'multiple_checkboxes','chicken'),(402,1762,'multiple_checkboxes','pork'),(412,1782,'multiple_checkboxes','Option one'),(422,1782,'multiple_checkboxes','Option two'),(432,1812,'multiple_checkboxes','Option one'),(442,1812,'multiple_checkboxes','Option two'),(542,2242,'multiple_checkboxes','Option one'),(552,2242,'multiple_checkboxes','Option two'),(562,2242,'multiple_checkboxes','option three'),(572,2242,'multiple_radios','Option one'),(582,2242,'multiple_radios','Option two'),(592,2242,'multiple_radios','beef'),(652,2312,'multiple_checkboxes','Option one'),(662,2312,'multiple_checkboxes','Option two'),(672,2322,'multiple_checkboxes','Option one'),(682,2322,'multiple_checkboxes','Option two'),(692,2432,'multiple_radios','Option one'),(702,2432,'multiple_radios','Option two'),(712,2432,'multiple_radios','three'),(722,2502,'multiple_checkboxes','Option one'),(732,2502,'multiple_checkboxes','Option two'),(742,2502,'multiple_radios','Option one'),(752,2502,'multiple_radios','Option two'),(762,2532,'multiple_radios','Option one'),(772,2532,'multiple_radios','Option two'),(782,2532,'address','Option one'),(792,2532,'address','Option two'),(802,2532,'StreetAddress','Option one'),(812,2532,'StreetAddress','Option two'),(822,2532,'address','Option one'),(832,2532,'address','Option two'),(902,2812,'multiple_radios',''),(912,2812,'multiple_radios','  '),(922,2812,'multiple_radios','    Option one'),(932,2812,'multiple_radios','  '),(942,2812,'multiple_radios','  '),(952,2812,'multiple_radios','    Option two'),(962,2812,'multiple_radios','  '),(972,2812,'multiple_radios','   '),(982,2812,'multiple_radios',''),(1012,2832,'multiple_radios','Tofu'),(1022,2832,'multiple_radios','Tofurkey'),(1112,2842,'address','One'),(1122,2842,'address','Two'),(1222,2852,'multiple_checkboxes','Odds'),(1232,2852,'multiple_checkboxes','Evens'),(1242,2852,'multiple_checkboxes','Primes'),(1252,2852,'multiple_radios','A'),(1262,2852,'multiple_radios','B'),(1272,2852,'multiple_radios','C'),(1282,2862,'multiple_checkboxes','Option one'),(1292,2862,'multiple_checkboxes','Option two'),(1432,3082,'multiple_checkboxes','Option one'),(1442,3082,'multiple_checkboxes','Option two'),(1452,3082,'multiple_radios','Option one'),(1462,3082,'multiple_radios','Option two'),(1472,3082,'multiple_radios_1','Option one'),(1482,3082,'multiple_radios_1','Option two'),(1502,3102,'multiple_checkboxes','Option one'),(1512,3102,'multiple_checkboxes','Option two'),(1522,3112,'multiple_radios','Option one'),(1532,3112,'multiple_radios','Option two'),(1542,3122,'multiple_checkboxes','Option one'),(1552,3122,'multiple_checkboxes','Option two'),(1562,3132,'multiple_radios','Option one'),(1572,3132,'multiple_radios','Option two'),(1582,3142,'multiple_radios','Option one'),(1592,3142,'multiple_radios','Option two'),(1602,3152,'multiple_radios','Option one'),(1612,3152,'multiple_radios','Option two'),(1722,3192,'multiple_radios','Blue'),(1732,3192,'multiple_radios','Yellow'),(1742,3192,'multiple_radios','Red'),(1752,3192,'multiple_radios','Green'),(1802,3232,'multiple_radios','Option one'),(1812,3232,'multiple_radios','Option two'),(1822,3342,'multiple_radios','Option one'),(1832,3342,'multiple_radios','Option two'),(1842,3376,'multiple_checkboxes','Option one'),(1843,3376,'multiple_checkboxes','Option two'),(1844,3376,'multiple_radios','Option one'),(1845,3376,'multiple_radios','Option two'),(1848,3386,'multiple_radios','Option one'),(1849,3386,'multiple_radios','Option two'),(1850,3387,'multiple_radios','Option one'),(1851,3387,'multiple_radios','Option two'),(1854,3102,'multiple_radios','Uno'),(1855,3102,'multiple_radios','Dos'),(1856,3102,'multiple_radios','Tres'),(1859,3390,'foo','a'),(1860,3390,'foo','b'),(1861,3390,'foo','c'),(1862,3392,'multiple_checkboxes','Option one'),(1863,3392,'multiple_checkboxes','Option two'),(1866,3383,'foo','a'),(1867,3383,'foo','b'),(1868,3383,'foo','c'),(1869,3393,'multiple_checkboxes','Option one'),(1870,3393,'multiple_checkboxes','Option two'),(1871,3394,'multiple_checkboxes','Option one'),(1872,3394,'multiple_checkboxes','Option two'),(1873,3395,'multiple_checkboxes','Option one'),(1874,3395,'multiple_checkboxes','Option two'),(1877,3396,'multiple_checkboxes','Option one'),(1878,3396,'multiple_checkboxes','Option two'),(1879,3397,'multiple_checkboxes','Option one'),(1880,3397,'multiple_checkboxes','Option two'),(1881,3397,'multiple_checkboxes_1','Option one'),(1882,3397,'multiple_checkboxes_1','Option two'),(1883,3397,'multiple_checkboxes_2','Option one'),(1884,3397,'multiple_checkboxes_2','Option two'),(1885,3398,'multiple_checkboxes','Option one'),(1886,3398,'multiple_checkboxes','Option two'),(1887,3400,'multiple_radios','Option one'),(1888,3400,'multiple_radios','Option two'),(1889,3401,'multiple_radios','Option one'),(1890,3401,'multiple_radios','Option two'),(1893,3405,'multiple_checkboxes','Option one'),(1894,3405,'multiple_checkboxes','Option two'),(1895,3405,'multiple_checkboxes_1','Option one'),(1896,3405,'multiple_checkboxes_1','Option two'),(1897,3405,'multiple_radios','Option one'),(1898,3405,'multiple_radios','Option two'),(1901,3407,'foo','a'),(1902,3407,'foo','b'),(1903,3407,'foo','c'),(1904,3407,'multiple_radios','Option one'),(1905,3407,'multiple_radios','Option two'),(1910,3408,'foo2','a'),(1911,3408,'foo2','b'),(1912,3408,'foo2','c'),(1913,3408,'foo1','1'),(1914,3408,'foo1','2'),(1915,3408,'foo1','3'),(1918,3419,'multiple_checkboxes','a'),(1919,3419,'multiple_checkboxes','b'),(1920,3419,'multiple_checkboxes','c'),(1927,3421,'multiple_checkboxes_1','a'),(1928,3421,'multiple_checkboxes_1','b'),(1929,3421,'multiple_checkboxes_1','c'),(1930,3420,'multiple_checkboxes','a'),(1931,3420,'multiple_checkboxes','b'),(1932,3420,'multiple_checkboxes','c'),(1933,3422,'multiple_checkboxes','Option one'),(1934,3422,'multiple_checkboxes','Option two'),(1937,3423,'also_address_of_adu','Yes'),(1938,3423,'also_address_of_adu','No'),(1939,22,'multiple_checkboxes','Option one'),(1940,22,'multiple_checkboxes','Option two'),(1941,3406,'multiple_checkboxes','Option one'),(1942,3406,'multiple_checkboxes','Option two'),(1943,3406,'multiple_radios','Option one'),(1944,3406,'multiple_radios','Option two'),(1945,3424,'multiple_checkboxes','Option one'),(1946,3424,'multiple_checkboxes','Option two'),(1947,3425,'multiple_checkboxes','Option one'),(1948,3425,'multiple_checkboxes','Option two'),(1949,3426,'multiple_checkboxes','Option one'),(1950,3426,'multiple_checkboxes','Option two'),(1951,3427,'multiple_checkboxes','Option one'),(1952,3427,'multiple_checkboxes','Option two'),(1953,3429,'multiple_checkboxes','Option one'),(1954,3429,'multiple_checkboxes','Option two'),(1955,3430,'multiple_checkboxes','Option one'),(1956,3430,'multiple_checkboxes','Option two'),(1957,3431,'multiple_radios','Option one'),(1958,3431,'multiple_radios','Option two'),(1959,3391,'multiple_radios','Option one'),(1960,3391,'multiple_radios','Option two'),(1963,3391,'multiple_radios_1','Eins'),(1964,3391,'multiple_radios_1','Zwei'),(1965,3391,'multiple_radios_1','Drei'),(1966,3437,'multiple_checkboxes','Option one'),(1967,3437,'multiple_checkboxes','Option two'),(1968,3439,'multiple_checkboxes','Option one'),(1969,3439,'multiple_checkboxes','Option two'),(1972,3439,'multiple_radios','a'),(1973,3439,'multiple_radios','b'),(1974,3439,'multiple_radios','c'),(1977,3441,'multiple_checkboxes','a'),(1978,3441,'multiple_checkboxes','b'),(1981,3442,'address_of_adu_select','Yes'),(1982,3442,'address_of_adu_select','No'),(1985,3442,'multiple_radios','Yes'),(1986,3442,'multiple_radios','No'),(1989,3442,'relationship_to_owner','Architect'),(1990,3442,'relationship_to_owner','Contractor'),(1991,3442,'relationship_to_owner','Engineer'),(1992,3442,'relationship_to_owner','Attorney'),(1993,3443,'multiple_checkboxes','Option one'),(1994,3443,'multiple_checkboxes','Option two'),(1995,3445,'multiple_checkboxes','Option one'),(1996,3445,'multiple_checkboxes','Option two'),(1997,3446,'multiple_checkboxes','Option one'),(1998,3446,'multiple_checkboxes','Option two'),(1999,3446,'multiple_radios','Option one'),(2000,3446,'multiple_radios','Option two'),(2001,3445,'multiple_radios','Option one'),(2002,3445,'multiple_radios','Option two'),(2003,3447,'multiple_checkboxes','Option one'),(2004,3447,'multiple_checkboxes','Option two'),(2008,3442,'multiple_checkboxes','Building a driveway or auto runway'),(2009,3442,'multiple_checkboxes','Using street space'),(2010,3442,'multiple_checkboxes','Changing the front facade'),(2011,3442,'multiple_checkboxes','Extending the building beyond the property line'),(2012,3442,'multiple_checkboxes','Plumbing work'),(2013,3442,'multiple_checkboxes','Electrical work'),(2014,3442,'multiple_checkboxes','Adding height to the existing building'),(2015,3442,'multiple_checkboxes','Adding a deck or horizontal extension'),(2018,3442,'multiple_radios_1','Yes'),(2019,3442,'multiple_radios_1','No'),(2021,3448,'multiple_checkboxes','Option one'),(2022,3448,'multiple_checkboxes','Option two'),(2023,3448,'multiple_radios','Option one'),(2024,3448,'multiple_radios','Option two'),(2028,3442,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2031,3442,'multiple_radios_2','Yes'),(2032,3442,'multiple_radios_2','No'),(2035,3442,'multiple_radios_3','Yes'),(2036,3442,'multiple_radios_3','No'),(2039,3442,'multiple_radios_4','Yes'),(2040,3442,'multiple_radios_4','No'),(2043,3442,'multiple_radios_5','Yes'),(2044,3442,'multiple_radios_5','No'),(2045,3450,'multiple_checkboxes','Option one'),(2046,3450,'multiple_checkboxes','Option two'),(2049,3442,'multiple_radios_6','Yes'),(2050,3442,'multiple_radios_6','No'),(2053,3442,'multiple_radios_7','Yes'),(2054,3442,'multiple_radios_7','No'),(2055,3442,'multiple_radios_8','Option one'),(2056,3442,'multiple_radios_8','Option two'),(2059,3442,'multiple_radios_9','Yes'),(2060,3442,'multiple_radios_9','No'),(2063,3442,'multiple_radios_10','Yes'),(2064,3442,'multiple_radios_10','No'),(2065,3442,'multiple_radios_11','Option one'),(2066,3442,'multiple_radios_11','Option two'),(2067,3442,'multiple_radios_11','Yes'),(2068,3442,'multiple_radios_11','No'),(2069,3442,'multiple_radios_12','Option one'),(2070,3442,'multiple_radios_12','Option two'),(2071,3442,'multiple_radios_12','Yes'),(2072,3442,'multiple_radios_12','No'),(2073,3442,'multiple_radios_13','Option one'),(2074,3442,'multiple_radios_13','Option two'),(2075,3442,'multiple_radios_13','Yes'),(2076,3442,'multiple_radios_13','No'),(2077,3442,'multiple_radios_14','Option one'),(2078,3442,'multiple_radios_14','Option two'),(2079,3442,'multiple_radios_14','Yes'),(2080,3442,'multiple_radios_14','No'),(2081,3442,'multiple_checkboxes_1','Option one'),(2082,3442,'multiple_checkboxes_1','Option two'),(2083,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2084,3442,'multiple_checkboxes_1','I have third-party insurance'),(2085,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2086,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2087,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2088,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2089,3442,'multiple_checkboxes_1','I have third-party insurance'),(2090,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2091,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2092,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2093,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2094,3442,'multiple_checkboxes_1','I have third-party insurance'),(2095,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2096,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2097,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2098,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2099,3442,'multiple_checkboxes_1','I have third-party insurance'),(2100,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2101,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2102,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2103,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2104,3442,'multiple_checkboxes_1','I have third-party insurance'),(2105,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2106,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2107,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2108,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2109,3442,'multiple_checkboxes_1','I have third-party insurance'),(2110,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2111,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2112,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2113,3442,'multiple_radios_15','Option one'),(2114,3442,'multiple_radios_15','Option two'),(2115,3442,'multiple_radios_15','Yes'),(2116,3442,'multiple_radios_15','No'),(2117,3442,'multiple_radios_15','Yes'),(2118,3442,'multiple_radios_15','No'),(2119,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2120,3442,'multiple_checkboxes_1','I have third-party insurance'),(2121,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2122,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2123,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2124,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2125,3442,'multiple_checkboxes_1','I have third-party insurance'),(2126,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2127,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2128,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2129,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2130,3442,'multiple_checkboxes_1','I have third-party insurance'),(2131,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2132,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2133,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2134,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2135,3442,'multiple_checkboxes_1','I have third-party insurance'),(2136,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2137,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2138,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2139,3442,'multiple_radios_16','Option one'),(2140,3442,'multiple_radios_16','Option two'),(2141,3442,'multiple_radios_16','Yes'),(2142,3442,'multiple_radios_16','No'),(2143,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2144,3442,'multiple_checkboxes_1','I have third-party insurance'),(2145,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2146,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2147,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2148,3442,'multiple_radios_16','Yes'),(2149,3442,'multiple_radios_16','No'),(2150,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2151,3442,'multiple_checkboxes_1','I have third-party insurance'),(2152,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2153,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2154,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2155,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2156,3442,'multiple_checkboxes_1','I have third-party insurance'),(2157,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2158,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2159,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2160,3442,'multiple_radios_17','Option one'),(2161,3442,'multiple_radios_17','Option two'),(2162,3442,'multiple_radios_17','Option one'),(2163,3442,'multiple_radios_17','Option two'),(2164,3442,'multiple_radios_17','Yes'),(2165,3442,'multiple_radios_17','No'),(2166,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2167,3442,'multiple_checkboxes_1','I have third-party insurance'),(2168,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2169,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2170,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2171,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2172,3442,'multiple_checkboxes_1','I have third-party insurance'),(2173,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2174,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2175,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2176,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2177,3442,'multiple_checkboxes_1','I have third-party insurance'),(2178,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2179,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&apos;m not hiring anyone.'),(2180,3442,'multiple_checkboxes_1','I don&apos;t need insurance because the work will cost under $100.'),(2181,3442,'multiple_radios_18','Option one'),(2182,3442,'multiple_radios_18','Option two'),(2183,3442,'multiple_radios_18','Yes'),(2184,3442,'multiple_radios_18','No'),(2185,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2186,3442,'multiple_checkboxes_1','I have third-party insurance'),(2187,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2188,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2189,3442,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2190,3464,'checkbox_1','Option one'),(2191,3464,'checkbox_1','Option two'),(2192,3464,'checkbox_1','option 4'),(2193,3468,'address_of_adu_select','Yes'),(2194,3468,'address_of_adu_select','No'),(2195,3468,'multiple_radios','Yes'),(2196,3468,'multiple_radios','No'),(2197,3468,'relationship_to_owner','Architect'),(2198,3468,'relationship_to_owner','Contractor'),(2199,3468,'relationship_to_owner','Engineer'),(2200,3468,'relationship_to_owner','Attorney'),(2201,3468,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2202,3468,'multiple_checkboxes','Building a driveway or auto runway'),(2203,3468,'multiple_checkboxes','Using street space'),(2204,3468,'multiple_checkboxes','Changing the front facade'),(2205,3468,'multiple_checkboxes','Extending the building beyond the property line'),(2206,3468,'multiple_checkboxes','Plumbing work'),(2207,3468,'multiple_checkboxes','Electrical work'),(2208,3468,'multiple_checkboxes','Adding height to the existing building'),(2209,3468,'multiple_checkboxes','Adding a deck or horizontal extension'),(2210,3468,'multiple_radios_1','Yes'),(2211,3468,'multiple_radios_1','No'),(2212,3468,'multiple_radios_2','Yes'),(2213,3468,'multiple_radios_2','No'),(2214,3468,'multiple_radios_3','Yes'),(2215,3468,'multiple_radios_3','No'),(2216,3468,'multiple_radios_4','Yes'),(2217,3468,'multiple_radios_4','No'),(2218,3468,'multiple_radios_5','Yes'),(2219,3468,'multiple_radios_5','No'),(2220,3468,'multiple_radios_6','Yes'),(2221,3468,'multiple_radios_6','No'),(2222,3468,'multiple_radios_7','Yes'),(2223,3468,'multiple_radios_7','No'),(2224,3468,'multiple_radios_8','Option one'),(2225,3468,'multiple_radios_8','Option two'),(2226,3468,'multiple_radios_9','Yes'),(2227,3468,'multiple_radios_9','No'),(2228,3468,'multiple_radios_10','Yes'),(2229,3468,'multiple_radios_10','No'),(2230,3468,'multiple_radios_11','Yes'),(2231,3468,'multiple_radios_11','No'),(2232,3468,'multiple_radios_12','Yes'),(2233,3468,'multiple_radios_12','No'),(2234,3468,'multiple_radios_13','Yes'),(2235,3468,'multiple_radios_13','No'),(2236,3468,'multiple_radios_14','Yes'),(2237,3468,'multiple_radios_14','No'),(2238,3468,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2239,3468,'multiple_checkboxes_1','I have third-party insurance'),(2240,3468,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2243,3468,'multiple_radios_15','Yes'),(2244,3468,'multiple_radios_15','No'),(2245,3468,'multiple_radios_16','Yes'),(2246,3468,'multiple_radios_16','No'),(2247,3468,'multiple_radios_17','Yes'),(2248,3468,'multiple_radios_17','No'),(2249,3468,'multiple_radios_18','Yes'),(2250,3468,'multiple_radios_18','No'),(2251,3468,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2252,3468,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2253,3470,'address_of_adu_select','Yes'),(2254,3470,'address_of_adu_select','No'),(2255,3470,'multiple_radios','Yes'),(2256,3470,'multiple_radios','No'),(2257,3470,'relationship_to_owner','Architect'),(2258,3470,'relationship_to_owner','Contractor'),(2259,3470,'relationship_to_owner','Engineer'),(2260,3470,'relationship_to_owner','Attorney'),(2261,3470,'relationship_to_owner','Other'),(2262,3470,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2263,3470,'multiple_checkboxes','Building a driveway or auto runway'),(2264,3470,'multiple_checkboxes','Using street space'),(2265,3470,'multiple_checkboxes','Changing the front facade'),(2266,3470,'multiple_checkboxes','Extending the building beyond the property line'),(2267,3470,'multiple_checkboxes','Plumbing work'),(2268,3470,'multiple_checkboxes','Electrical work'),(2269,3470,'multiple_checkboxes','Adding height to the existing building'),(2270,3470,'multiple_checkboxes','Adding a deck or horizontal extension'),(2271,3470,'multiple_radios_1','Yes'),(2272,3470,'multiple_radios_1','No'),(2273,3470,'multiple_radios_2','Yes'),(2274,3470,'multiple_radios_2','No'),(2275,3470,'multiple_radios_3','Yes'),(2276,3470,'multiple_radios_3','No'),(2277,3470,'multiple_radios_4','Yes'),(2278,3470,'multiple_radios_4','No'),(2279,3470,'multiple_radios_5','Yes'),(2280,3470,'multiple_radios_5','No'),(2281,3470,'multiple_radios_6','Yes'),(2282,3470,'multiple_radios_6','No'),(2283,3470,'multiple_radios_7','Yes'),(2284,3470,'multiple_radios_7','No'),(2285,3470,'multiple_radios_8','Option one'),(2286,3470,'multiple_radios_8','Option two'),(2287,3470,'multiple_radios_9','Yes'),(2288,3470,'multiple_radios_9','No'),(2289,3470,'multiple_radios_10','Yes'),(2290,3470,'multiple_radios_10','No'),(2291,3470,'multiple_radios_11','Yes'),(2292,3470,'multiple_radios_11','No'),(2293,3470,'multiple_radios_12','Yes'),(2294,3470,'multiple_radios_12','No'),(2295,3470,'multiple_radios_13','Yes'),(2296,3470,'multiple_radios_13','No'),(2297,3470,'multiple_radios_14','Yes'),(2298,3470,'multiple_radios_14','No'),(2299,3470,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2300,3470,'multiple_checkboxes_1','I have third-party insurance'),(2301,3470,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2302,3470,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2303,3470,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2304,3470,'multiple_radios_15','Yes'),(2305,3470,'multiple_radios_15','No'),(2306,3470,'multiple_radios_16','Yes'),(2307,3470,'multiple_radios_16','No'),(2308,3470,'multiple_radios_17','Yes'),(2309,3470,'multiple_radios_17','No'),(2310,3470,'multiple_radios_18','Yes'),(2311,3470,'multiple_radios_18','No'),(2312,3471,'address_of_adu_select','Yes'),(2313,3471,'address_of_adu_select','No'),(2314,3471,'multiple_radios','Yes'),(2315,3471,'multiple_radios','No'),(2316,3471,'relationship_to_owner','Architect'),(2317,3471,'relationship_to_owner','Contractor'),(2318,3471,'relationship_to_owner','Engineer'),(2319,3471,'relationship_to_owner','Attorney'),(2320,3471,'relationship_to_owner','Other'),(2321,3471,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2322,3471,'multiple_checkboxes','Building a driveway or auto runway'),(2323,3471,'multiple_checkboxes','Using street space'),(2324,3471,'multiple_checkboxes','Changing the front facade'),(2325,3471,'multiple_checkboxes','Extending the building beyond the property line'),(2326,3471,'multiple_checkboxes','Plumbing work'),(2327,3471,'multiple_checkboxes','Electrical work'),(2328,3471,'multiple_checkboxes','Adding height to the existing building'),(2329,3471,'multiple_checkboxes','Adding a deck or horizontal extension'),(2330,3471,'multiple_radios_1','Yes'),(2331,3471,'multiple_radios_1','No'),(2332,3471,'multiple_radios_2','Yes'),(2333,3471,'multiple_radios_2','No'),(2334,3471,'multiple_radios_3','Yes'),(2335,3471,'multiple_radios_3','No'),(2336,3471,'multiple_radios_4','Yes'),(2337,3471,'multiple_radios_4','No'),(2338,3471,'multiple_radios_5','Yes'),(2339,3471,'multiple_radios_5','No'),(2340,3471,'multiple_radios_6','Yes'),(2341,3471,'multiple_radios_6','No'),(2342,3471,'multiple_radios_7','Yes'),(2343,3471,'multiple_radios_7','No'),(2344,3471,'multiple_radios_8','Option one'),(2345,3471,'multiple_radios_8','Option two'),(2346,3471,'multiple_radios_9','Yes'),(2347,3471,'multiple_radios_9','No'),(2348,3471,'multiple_radios_10','Yes'),(2349,3471,'multiple_radios_10','No'),(2350,3471,'multiple_radios_11','Yes'),(2351,3471,'multiple_radios_11','No'),(2352,3471,'multiple_radios_12','Yes'),(2353,3471,'multiple_radios_12','No'),(2354,3471,'multiple_radios_13','Yes'),(2355,3471,'multiple_radios_13','No'),(2356,3471,'multiple_radios_14','Yes'),(2357,3471,'multiple_radios_14','No'),(2358,3471,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2359,3471,'multiple_checkboxes_1','I have third-party insurance'),(2360,3471,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2361,3471,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2362,3471,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2363,3471,'multiple_radios_15','Yes'),(2364,3471,'multiple_radios_15','No'),(2365,3471,'multiple_radios_16','Yes'),(2366,3471,'multiple_radios_16','No'),(2367,3471,'multiple_radios_17','Yes'),(2368,3471,'multiple_radios_17','No'),(2369,3471,'multiple_radios_18','Yes'),(2370,3471,'multiple_radios_18','No'),(2371,3472,'address_of_adu_select','Yes'),(2372,3472,'address_of_adu_select','No'),(2373,3472,'multiple_radios','Yes'),(2374,3472,'multiple_radios','No'),(2375,3472,'relationship_to_owner','Architect'),(2376,3472,'relationship_to_owner','Contractor'),(2377,3472,'relationship_to_owner','Engineer'),(2378,3472,'relationship_to_owner','Attorney'),(2379,3472,'relationship_to_owner','Other'),(2380,3472,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2381,3472,'multiple_checkboxes','Building a driveway or auto runway'),(2382,3472,'multiple_checkboxes','Using street space'),(2383,3472,'multiple_checkboxes','Changing the front facade'),(2384,3472,'multiple_checkboxes','Extending the building beyond the property line'),(2385,3472,'multiple_checkboxes','Plumbing work'),(2386,3472,'multiple_checkboxes','Electrical work'),(2387,3472,'multiple_checkboxes','Adding height to the existing building'),(2388,3472,'multiple_checkboxes','Adding a deck or horizontal extension'),(2389,3472,'multiple_radios_1','Yes'),(2390,3472,'multiple_radios_1','No'),(2391,3472,'multiple_radios_2','Yes'),(2392,3472,'multiple_radios_2','No'),(2393,3472,'multiple_radios_3','Yes'),(2394,3472,'multiple_radios_3','No'),(2395,3472,'multiple_radios_4','Yes'),(2396,3472,'multiple_radios_4','No'),(2397,3472,'multiple_radios_5','Yes'),(2398,3472,'multiple_radios_5','No'),(2399,3472,'multiple_radios_6','Yes'),(2400,3472,'multiple_radios_6','No'),(2401,3472,'multiple_radios_7','Yes'),(2402,3472,'multiple_radios_7','No'),(2403,3472,'multiple_radios_8','Option one'),(2404,3472,'multiple_radios_8','Option two'),(2405,3472,'multiple_radios_9','Yes'),(2406,3472,'multiple_radios_9','No'),(2407,3472,'multiple_radios_10','Yes'),(2408,3472,'multiple_radios_10','No'),(2409,3472,'multiple_radios_11','Yes'),(2410,3472,'multiple_radios_11','No'),(2411,3472,'multiple_radios_12','Yes'),(2412,3472,'multiple_radios_12','No'),(2413,3472,'multiple_radios_13','Yes'),(2414,3472,'multiple_radios_13','No'),(2415,3472,'multiple_radios_14','Yes'),(2416,3472,'multiple_radios_14','No'),(2417,3472,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2418,3472,'multiple_checkboxes_1','I have third-party insurance'),(2419,3472,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2420,3472,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2421,3472,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2422,3472,'multiple_radios_15','Yes'),(2423,3472,'multiple_radios_15','No'),(2424,3472,'multiple_radios_16','Yes'),(2425,3472,'multiple_radios_16','No'),(2426,3472,'multiple_radios_17','Yes'),(2427,3472,'multiple_radios_17','No'),(2428,3472,'multiple_radios_18','Yes'),(2429,3472,'multiple_radios_18','No'),(2430,3473,'address_of_adu_select','Yes'),(2431,3473,'address_of_adu_select','No'),(2432,3473,'multiple_radios','Yes'),(2433,3473,'multiple_radios','No'),(2434,3473,'relationship_to_owner','Architect'),(2435,3473,'relationship_to_owner','Contractor'),(2436,3473,'relationship_to_owner','Engineer'),(2437,3473,'relationship_to_owner','Attorney'),(2438,3473,'relationship_to_owner','Other'),(2439,3473,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2440,3473,'multiple_checkboxes','Building a driveway or auto runway'),(2441,3473,'multiple_checkboxes','Using street space'),(2442,3473,'multiple_checkboxes','Changing the front facade'),(2443,3473,'multiple_checkboxes','Extending the building beyond the property line'),(2444,3473,'multiple_checkboxes','Plumbing work'),(2445,3473,'multiple_checkboxes','Electrical work'),(2446,3473,'multiple_checkboxes','Adding height to the existing building'),(2447,3473,'multiple_checkboxes','Adding a deck or horizontal extension'),(2448,3473,'multiple_radios_1','Yes'),(2449,3473,'multiple_radios_1','No'),(2450,3473,'multiple_radios_2','Yes'),(2451,3473,'multiple_radios_2','No'),(2452,3473,'multiple_radios_3','Yes'),(2453,3473,'multiple_radios_3','No'),(2454,3473,'multiple_radios_4','Yes'),(2455,3473,'multiple_radios_4','No'),(2456,3473,'multiple_radios_5','Yes'),(2457,3473,'multiple_radios_5','No'),(2458,3473,'multiple_radios_6','Yes'),(2459,3473,'multiple_radios_6','No'),(2460,3473,'multiple_radios_7','Yes'),(2461,3473,'multiple_radios_7','No'),(2462,3473,'multiple_radios_8','Option one'),(2463,3473,'multiple_radios_8','Option two'),(2464,3473,'multiple_radios_9','Yes'),(2465,3473,'multiple_radios_9','No'),(2466,3473,'multiple_radios_10','Yes'),(2467,3473,'multiple_radios_10','No'),(2468,3473,'multiple_radios_11','Yes'),(2469,3473,'multiple_radios_11','No'),(2470,3473,'multiple_radios_12','Yes'),(2471,3473,'multiple_radios_12','No'),(2472,3473,'multiple_radios_13','Yes'),(2473,3473,'multiple_radios_13','No'),(2474,3473,'multiple_radios_14','Yes'),(2475,3473,'multiple_radios_14','No'),(2476,3473,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2477,3473,'multiple_checkboxes_1','I have third-party insurance'),(2478,3473,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2479,3473,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2480,3473,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2481,3473,'multiple_radios_15','Yes'),(2482,3473,'multiple_radios_15','No'),(2483,3473,'multiple_radios_16','Yes'),(2484,3473,'multiple_radios_16','No'),(2485,3473,'multiple_radios_17','Yes'),(2486,3473,'multiple_radios_17','No'),(2487,3473,'multiple_radios_18','Yes'),(2488,3473,'multiple_radios_18','No'),(2489,3474,'address_of_adu_select','Yes'),(2490,3474,'address_of_adu_select','No'),(2491,3474,'multiple_radios','Yes'),(2492,3474,'multiple_radios','No'),(2493,3474,'relationship_to_owner','Architect'),(2494,3474,'relationship_to_owner','Contractor'),(2495,3474,'relationship_to_owner','Engineer'),(2496,3474,'relationship_to_owner','Attorney'),(2497,3474,'relationship_to_owner','Other'),(2498,3474,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2499,3474,'multiple_checkboxes','Building a driveway or auto runway'),(2500,3474,'multiple_checkboxes','Using street space'),(2501,3474,'multiple_checkboxes','Changing the front facade'),(2502,3474,'multiple_checkboxes','Extending the building beyond the property line'),(2503,3474,'multiple_checkboxes','Plumbing work'),(2504,3474,'multiple_checkboxes','Electrical work'),(2505,3474,'multiple_checkboxes','Adding height to the existing building'),(2506,3474,'multiple_checkboxes','Adding a deck or horizontal extension'),(2507,3474,'multiple_radios_1','Yes'),(2508,3474,'multiple_radios_1','No'),(2509,3474,'multiple_radios_2','Yes'),(2510,3474,'multiple_radios_2','No'),(2511,3474,'multiple_radios_3','Yes'),(2512,3474,'multiple_radios_3','No'),(2513,3474,'multiple_radios_4','Yes'),(2514,3474,'multiple_radios_4','No'),(2515,3474,'multiple_radios_5','Yes'),(2516,3474,'multiple_radios_5','No'),(2517,3474,'multiple_radios_6','Yes'),(2518,3474,'multiple_radios_6','No'),(2519,3474,'multiple_radios_7','Yes'),(2520,3474,'multiple_radios_7','No'),(2521,3474,'multiple_radios_8','Option one'),(2522,3474,'multiple_radios_8','Option two'),(2523,3474,'multiple_radios_9','Yes'),(2524,3474,'multiple_radios_9','No'),(2525,3474,'multiple_radios_10','Yes'),(2526,3474,'multiple_radios_10','No'),(2527,3474,'multiple_radios_11','Yes'),(2528,3474,'multiple_radios_11','No'),(2529,3474,'multiple_radios_12','Yes'),(2530,3474,'multiple_radios_12','No'),(2531,3474,'multiple_radios_13','Yes'),(2532,3474,'multiple_radios_13','No'),(2533,3474,'multiple_radios_14','Yes'),(2534,3474,'multiple_radios_14','No'),(2535,3474,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2536,3474,'multiple_checkboxes_1','I have third-party insurance'),(2537,3474,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2538,3474,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2539,3474,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2540,3474,'multiple_radios_15','Yes'),(2541,3474,'multiple_radios_15','No'),(2542,3474,'multiple_radios_16','Yes'),(2543,3474,'multiple_radios_16','No'),(2544,3474,'multiple_radios_17','Yes'),(2545,3474,'multiple_radios_17','No'),(2546,3474,'multiple_radios_18','Yes'),(2547,3474,'multiple_radios_18','No'),(2548,3475,'address_of_adu_select','Yes'),(2549,3475,'address_of_adu_select','No'),(2550,3475,'multiple_radios','Yes'),(2551,3475,'multiple_radios','No'),(2552,3475,'relationship_to_owner','Architect'),(2553,3475,'relationship_to_owner','Contractor'),(2554,3475,'relationship_to_owner','Engineer'),(2555,3475,'relationship_to_owner','Attorney'),(2556,3475,'relationship_to_owner','Other'),(2557,3475,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2558,3475,'multiple_checkboxes','Building a driveway or auto runway'),(2559,3475,'multiple_checkboxes','Using street space'),(2560,3475,'multiple_checkboxes','Changing the front facade'),(2561,3475,'multiple_checkboxes','Extending the building beyond the property line'),(2562,3475,'multiple_checkboxes','Plumbing work'),(2563,3475,'multiple_checkboxes','Electrical work'),(2564,3475,'multiple_checkboxes','Adding height to the existing building'),(2565,3475,'multiple_checkboxes','Adding a deck or horizontal extension'),(2566,3475,'multiple_radios_1','Yes'),(2567,3475,'multiple_radios_1','No'),(2568,3475,'multiple_radios_2','Yes'),(2569,3475,'multiple_radios_2','No'),(2570,3475,'multiple_radios_3','Yes'),(2571,3475,'multiple_radios_3','No'),(2572,3475,'multiple_radios_4','Yes'),(2573,3475,'multiple_radios_4','No'),(2574,3475,'multiple_radios_5','Yes'),(2575,3475,'multiple_radios_5','No'),(2576,3475,'multiple_radios_6','Yes'),(2577,3475,'multiple_radios_6','No'),(2578,3475,'multiple_radios_7','Yes'),(2579,3475,'multiple_radios_7','No'),(2580,3475,'multiple_radios_8','Option one'),(2581,3475,'multiple_radios_8','Option two'),(2582,3475,'multiple_radios_9','Yes'),(2583,3475,'multiple_radios_9','No'),(2584,3475,'multiple_radios_10','Yes'),(2585,3475,'multiple_radios_10','No'),(2586,3475,'multiple_radios_11','Yes'),(2587,3475,'multiple_radios_11','No'),(2588,3475,'multiple_radios_12','Yes'),(2589,3475,'multiple_radios_12','No'),(2590,3475,'multiple_radios_13','Yes'),(2591,3475,'multiple_radios_13','No'),(2592,3475,'multiple_radios_14','Yes'),(2593,3475,'multiple_radios_14','No'),(2594,3475,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2595,3475,'multiple_checkboxes_1','I have third-party insurance'),(2596,3475,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2597,3475,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2598,3475,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2599,3475,'multiple_radios_15','Yes'),(2600,3475,'multiple_radios_15','No'),(2601,3475,'multiple_radios_16','Yes'),(2602,3475,'multiple_radios_16','No'),(2603,3475,'multiple_radios_17','Yes'),(2604,3475,'multiple_radios_17','No'),(2605,3475,'multiple_radios_18','Yes'),(2606,3475,'multiple_radios_18','No'),(2607,3476,'address_of_adu_select','Yes'),(2608,3476,'address_of_adu_select','No'),(2609,3476,'multiple_radios','Yes'),(2610,3476,'multiple_radios','No'),(2611,3476,'relationship_to_owner','Architect'),(2612,3476,'relationship_to_owner','Contractor'),(2613,3476,'relationship_to_owner','Engineer'),(2614,3476,'relationship_to_owner','Attorney'),(2615,3476,'relationship_to_owner','Other'),(2616,3476,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2617,3476,'multiple_checkboxes','Building a driveway or auto runway'),(2618,3476,'multiple_checkboxes','Using street space'),(2619,3476,'multiple_checkboxes','Changing the front facade'),(2620,3476,'multiple_checkboxes','Extending the building beyond the property line'),(2621,3476,'multiple_checkboxes','Plumbing work'),(2622,3476,'multiple_checkboxes','Electrical work'),(2623,3476,'multiple_checkboxes','Adding height to the existing building'),(2624,3476,'multiple_checkboxes','Adding a deck or horizontal extension'),(2625,3476,'multiple_radios_1','Yes'),(2626,3476,'multiple_radios_1','No'),(2627,3476,'multiple_radios_2','Yes'),(2628,3476,'multiple_radios_2','No'),(2629,3476,'multiple_radios_3','Yes'),(2630,3476,'multiple_radios_3','No'),(2631,3476,'multiple_radios_4','Yes'),(2632,3476,'multiple_radios_4','No'),(2633,3476,'multiple_radios_5','Yes'),(2634,3476,'multiple_radios_5','No'),(2635,3476,'multiple_radios_6','Yes'),(2636,3476,'multiple_radios_6','No'),(2637,3476,'multiple_radios_7','Yes'),(2638,3476,'multiple_radios_7','No'),(2639,3476,'multiple_radios_8','Option one'),(2640,3476,'multiple_radios_8','Option two'),(2641,3476,'multiple_radios_9','Yes'),(2642,3476,'multiple_radios_9','No'),(2643,3476,'multiple_radios_10','Yes'),(2644,3476,'multiple_radios_10','No'),(2645,3476,'multiple_radios_11','Yes'),(2646,3476,'multiple_radios_11','No'),(2647,3476,'multiple_radios_12','Yes'),(2648,3476,'multiple_radios_12','No'),(2649,3476,'multiple_radios_13','Yes'),(2650,3476,'multiple_radios_13','No'),(2651,3476,'multiple_radios_14','Yes'),(2652,3476,'multiple_radios_14','No'),(2653,3476,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2654,3476,'multiple_checkboxes_1','I have third-party insurance'),(2655,3476,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2656,3476,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2657,3476,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2658,3476,'multiple_radios_15','Yes'),(2659,3476,'multiple_radios_15','No'),(2660,3476,'multiple_radios_16','Yes'),(2661,3476,'multiple_radios_16','No'),(2662,3476,'multiple_radios_17','Yes'),(2663,3476,'multiple_radios_17','No'),(2664,3476,'multiple_radios_18','Yes'),(2665,3476,'multiple_radios_18','No'),(2666,3477,'address_of_adu_select','Yes'),(2667,3477,'address_of_adu_select','No'),(2668,3477,'multiple_radios','Yes'),(2669,3477,'multiple_radios','No'),(2670,3477,'relationship_to_owner','Architect'),(2671,3477,'relationship_to_owner','Contractor'),(2672,3477,'relationship_to_owner','Engineer'),(2673,3477,'relationship_to_owner','Attorney'),(2674,3477,'relationship_to_owner','Other'),(2675,3477,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2676,3477,'multiple_checkboxes','Building a driveway or auto runway'),(2677,3477,'multiple_checkboxes','Using street space'),(2678,3477,'multiple_checkboxes','Changing the front facade'),(2679,3477,'multiple_checkboxes','Extending the building beyond the property line'),(2680,3477,'multiple_checkboxes','Plumbing work'),(2681,3477,'multiple_checkboxes','Electrical work'),(2682,3477,'multiple_checkboxes','Adding height to the existing building'),(2683,3477,'multiple_checkboxes','Adding a deck or horizontal extension'),(2684,3477,'multiple_radios_1','Yes'),(2685,3477,'multiple_radios_1','No'),(2686,3477,'multiple_radios_2','Yes'),(2687,3477,'multiple_radios_2','No'),(2688,3477,'multiple_radios_3','Yes'),(2689,3477,'multiple_radios_3','No'),(2690,3477,'multiple_radios_4','Yes'),(2691,3477,'multiple_radios_4','No'),(2692,3477,'multiple_radios_5','Yes'),(2693,3477,'multiple_radios_5','No'),(2694,3477,'multiple_radios_6','Yes'),(2695,3477,'multiple_radios_6','No'),(2696,3477,'multiple_radios_7','Yes'),(2697,3477,'multiple_radios_7','No'),(2698,3477,'multiple_radios_8','Option one'),(2699,3477,'multiple_radios_8','Option two'),(2700,3477,'multiple_radios_9','Yes'),(2701,3477,'multiple_radios_9','No'),(2702,3477,'multiple_radios_10','Yes'),(2703,3477,'multiple_radios_10','No'),(2704,3477,'multiple_radios_11','Yes'),(2705,3477,'multiple_radios_11','No'),(2706,3477,'multiple_radios_12','Yes'),(2707,3477,'multiple_radios_12','No'),(2708,3477,'multiple_radios_13','Yes'),(2709,3477,'multiple_radios_13','No'),(2710,3477,'multiple_radios_14','Yes'),(2711,3477,'multiple_radios_14','No'),(2712,3477,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2713,3477,'multiple_checkboxes_1','I have third-party insurance'),(2714,3477,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2715,3477,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2716,3477,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2717,3477,'multiple_radios_15','Yes'),(2718,3477,'multiple_radios_15','No'),(2719,3477,'multiple_radios_16','Yes'),(2720,3477,'multiple_radios_16','No'),(2721,3477,'multiple_radios_17','Yes'),(2722,3477,'multiple_radios_17','No'),(2723,3477,'multiple_radios_18','Yes'),(2724,3477,'multiple_radios_18','No'),(2725,3478,'address_of_adu_select','Yes'),(2726,3478,'address_of_adu_select','No'),(2727,3478,'multiple_radios','Yes'),(2728,3478,'multiple_radios','No'),(2729,3478,'relationship_to_owner','Architect'),(2730,3478,'relationship_to_owner','Contractor'),(2731,3478,'relationship_to_owner','Engineer'),(2732,3478,'relationship_to_owner','Attorney'),(2733,3478,'relationship_to_owner','Other'),(2734,3478,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2735,3478,'multiple_checkboxes','Building a driveway or auto runway'),(2736,3478,'multiple_checkboxes','Using street space'),(2737,3478,'multiple_checkboxes','Changing the front facade'),(2738,3478,'multiple_checkboxes','Extending the building beyond the property line'),(2739,3478,'multiple_checkboxes','Plumbing work'),(2740,3478,'multiple_checkboxes','Electrical work'),(2741,3478,'multiple_checkboxes','Adding height to the existing building'),(2742,3478,'multiple_checkboxes','Adding a deck or horizontal extension'),(2743,3478,'multiple_radios_1','Yes'),(2744,3478,'multiple_radios_1','No'),(2745,3478,'multiple_radios_2','Yes'),(2746,3478,'multiple_radios_2','No'),(2747,3478,'multiple_radios_3','Yes'),(2748,3478,'multiple_radios_3','No'),(2749,3478,'multiple_radios_4','Yes'),(2750,3478,'multiple_radios_4','No'),(2751,3478,'multiple_radios_5','Yes'),(2752,3478,'multiple_radios_5','No'),(2753,3478,'multiple_radios_6','Yes'),(2754,3478,'multiple_radios_6','No'),(2755,3478,'multiple_radios_7','Yes'),(2756,3478,'multiple_radios_7','No'),(2757,3478,'multiple_radios_8','Option one'),(2758,3478,'multiple_radios_8','Option two'),(2759,3478,'multiple_radios_9','Yes'),(2760,3478,'multiple_radios_9','No'),(2761,3478,'multiple_radios_10','Yes'),(2762,3478,'multiple_radios_10','No'),(2763,3478,'multiple_radios_11','Yes'),(2764,3478,'multiple_radios_11','No'),(2765,3478,'multiple_radios_12','Yes'),(2766,3478,'multiple_radios_12','No'),(2767,3478,'multiple_radios_13','Yes'),(2768,3478,'multiple_radios_13','No'),(2769,3478,'multiple_radios_14','Yes'),(2770,3478,'multiple_radios_14','No'),(2771,3478,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2772,3478,'multiple_checkboxes_1','I have third-party insurance'),(2773,3478,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2774,3478,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2775,3478,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2776,3478,'multiple_radios_15','Yes'),(2777,3478,'multiple_radios_15','No'),(2778,3478,'multiple_radios_16','Yes'),(2779,3478,'multiple_radios_16','No'),(2780,3478,'multiple_radios_17','Yes'),(2781,3478,'multiple_radios_17','No'),(2782,3478,'multiple_radios_18','Yes'),(2783,3478,'multiple_radios_18','No'),(2784,3442,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2785,3442,'multiple_checkboxes_1','I have third-party insurance'),(2786,3442,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2787,3442,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2788,3442,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2789,3479,'address_of_adu_select','Yes'),(2790,3479,'address_of_adu_select','No'),(2791,3479,'multiple_radios','Yes'),(2792,3479,'multiple_radios','No'),(2793,3479,'relationship_to_owner','Architect'),(2794,3479,'relationship_to_owner','Contractor'),(2795,3479,'relationship_to_owner','Engineer'),(2796,3479,'relationship_to_owner','Attorney'),(2797,3479,'multiple_checkboxes','Repairing or replacing the buildings foundation [ADD APOSTROPHE]'),(2798,3479,'multiple_checkboxes','Building a driveway or auto runway'),(2799,3479,'multiple_checkboxes','Using street space'),(2800,3479,'multiple_checkboxes','Changing the front facade'),(2801,3479,'multiple_checkboxes','Extending the building beyond the property line'),(2802,3479,'multiple_checkboxes','Plumbing work'),(2803,3479,'multiple_checkboxes','Electrical work'),(2804,3479,'multiple_checkboxes','Adding height to the existing building'),(2805,3479,'multiple_checkboxes','Adding a deck or horizontal extension'),(2806,3479,'multiple_radios_1','Yes'),(2807,3479,'multiple_radios_1','No'),(2808,3479,'multiple_radios_2','Yes'),(2809,3479,'multiple_radios_2','No'),(2810,3479,'multiple_radios_3','Yes'),(2811,3479,'multiple_radios_3','No'),(2812,3479,'multiple_radios_4','Yes'),(2813,3479,'multiple_radios_4','No'),(2814,3479,'multiple_radios_5','Yes'),(2815,3479,'multiple_radios_5','No'),(2816,3479,'multiple_radios_6','Yes'),(2817,3479,'multiple_radios_6','No'),(2818,3479,'multiple_radios_7','Yes'),(2819,3479,'multiple_radios_7','No'),(2820,3479,'multiple_radios_8','Option one'),(2821,3479,'multiple_radios_8','Option two'),(2822,3479,'multiple_radios_9','Yes'),(2823,3479,'multiple_radios_9','No'),(2824,3479,'multiple_radios_10','Yes'),(2825,3479,'multiple_radios_10','No'),(2826,3479,'multiple_radios_11','Yes'),(2827,3479,'multiple_radios_11','No'),(2828,3479,'multiple_radios_12','Yes'),(2829,3479,'multiple_radios_12','No'),(2830,3479,'multiple_radios_13','Yes'),(2831,3479,'multiple_radios_13','No'),(2832,3479,'multiple_radios_14','Yes'),(2833,3479,'multiple_radios_14','No'),(2834,3479,'multiple_checkboxes_1','I am self-insured and have a certificate of consent.'),(2835,3479,'multiple_checkboxes_1','I have third-party insurance'),(2836,3479,'multiple_checkboxes_1','I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]'),(2837,3479,'multiple_checkboxes_1','I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.'),(2838,3479,'multiple_checkboxes_1','I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.'),(2839,3479,'multiple_radios_15','Yes'),(2840,3479,'multiple_radios_15','No'),(2841,3479,'multiple_radios_16','Yes'),(2842,3479,'multiple_radios_16','No'),(2843,3479,'multiple_radios_17','Yes'),(2844,3479,'multiple_radios_17','No'),(2845,3479,'multiple_radios_18','Yes'),(2846,3479,'multiple_radios_18','No');
/*!40000 ALTER TABLE `enum_mappings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3480 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (2,'',NULL,NULL,NULL),(12,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging-pr-65.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"Apply for a Legacy Business grant\",\"backend\":\"db\"},\"data\":[{\"textarea\":\"Contact information\",\"id\":\"contact_info\",\"formtype\":\"m06\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"Like name@email.com\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"multiple_radios\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Business information\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"How many locations does your business have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"number_locations\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"number_locations\"},{\"label\":\"Your business name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_name\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_name\"},{\"label\":\"Location 1 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_1\",\"formtype\":\"i02\",\"name\":\"business_address_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Location 1 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_1\",\"formtype\":\"i02\",\"name\":\"business_city_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Location 1 state\",\"placeholder\":\"placeholder\",\"help\":\"\",\"id\":\"business_state_1\",\"formtype\":\"s15\",\"name\":\"business_state_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Location 1 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_1\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_1\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 2 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_2\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_2\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]}},{\"label\":\"Location 2 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_2\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_2\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]}},{\"label\":\"Location 2 state\",\"placeholder\":\"placeholder\",\"help\":\"\",\"id\":\"business_state_2\",\"formtype\":\"s15\",\"name\":\"business_state_2\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]}},{\"label\":\"Location 2 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_2\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_2\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 3 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_3\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_3\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]}},{\"label\":\"Location 3 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_3\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_3\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]}},{\"label\":\"Location 3 state\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_state_3\",\"formtype\":\"s15\",\"name\":\"business_state_3\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]}},{\"label\":\"Location 3 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_3\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_3\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 4 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_4\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_4\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]}},{\"label\":\"Location 4 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_4\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_4\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]}},{\"label\":\"Location 4 state\",\"placeholder\":\"placeholder\",\"help\":\"\",\"id\":\"business_state_4\",\"formtype\":\"s15\",\"name\":\"business_state_4\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]}},{\"label\":\"Location 4 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 5 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_5\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_5\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]}},{\"label\":\"Location 5 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_5\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_5\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]}},{\"label\":\"Location 5 state\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_state_5\",\"formtype\":\"s15\",\"name\":\"business_state_5\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]}},{\"label\":\"Location 5 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_5\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_5\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Rent or mortgage to gross revenue\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"How much did your business spend on rent during 2017?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"spend_2017\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\",\"name\":\"spend_2017\"},{\"label\":\"How much did your business earn in terms of gross revenue in 2017?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"gross_revenue_2017\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\",\"name\":\"gross_revenue_2017\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden_100\",\"formtype\":\"m11\",\"type\":\"text\",\"value\":\"100\",\"name\":\"hidden_100\"},{\"label\":\"Percent of rent or mortgage that is gross\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"percent_rent_mortgage\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"percent_rent_mortgage\",\"calculations\":[\"spend_2017\",\"Divided by\",\"gross_revenue_2017\",\"Multiplied by\",\"hidden_100\"]},{\"label\":\"Business Closure\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Was your business closed at any time from July 1, 2017 to June 30, 2018?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"business_closure\",\"formtype\":\"s08\",\"value\":\"yes\",\"name\":\"business_closure\",\"required\":\"true\"},{\"label\":\"When did your business close?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"close_date\",\"formtype\":\"d02\",\"name\":\"close_date\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"When did your business reopen?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"reopen_date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\",\"name\":\"reopen_date\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"business_closure\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Which location was closed?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"closed_address\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"closed_address\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"business_closure\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"What was the reason this location was closed?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"reason_closed\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"reason_closed\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"business_closure\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Employees\",\"id\":\"page_separator_3\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"How many full-time employees did you employ between July 1, 2017 to June 30, 2018?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"num_fte\",\"formtype\":\"d06\",\"name\":\"num_fte\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden_500\",\"formtype\":\"m11\",\"type\":\"text\",\"value\":\"500\",\"name\":\"hidden_500\"},{\"label\":\"How much money are you asking for?\",\"placeholder\":\"\",\"help\":\"You can ask up to $500 for every full-time employee up to a total of $50,000\",\"id\":\"how_much_money\",\"formtype\":\"d08\",\"name\":\"how_much_money\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"num_fte\",\"Multiplied by\",\"hidden_500\"]},{\"label\":\"How did you spend last years grant?\",\"id\":\"page_separator_6\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Advisor (like financial, legal)\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_advisor_pct\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_advisor_pct\"},{\"label\":\"Associate membership\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_assoc_mem\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_assoc_mem\"},{\"label\":\"Equipment\\/technology\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_equipment\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_equipment\"},{\"label\":\"Human resources\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_human_resources\",\"formtype\":\"d06\",\"name\":\"past_human_resources\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Inventory\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_inventory\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_inventory\"},{\"label\":\"Marketing\\/ promotion\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_marketing_promotion\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_marketing_promotion\"},{\"label\":\"Office supplies\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_office_supplies\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_office_supplies\"},{\"label\":\"Rent\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_rent\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_rent\"},{\"label\":\"Security\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_security\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_security\"},{\"label\":\"Tenant improvements (like business improvements)\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_tenant_improvements\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_tenant_improvements\"},{\"label\":\"Other\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_other_pct\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_other_pct\"},{\"label\":\"Total\",\"placeholder\":\"\",\"help\":\"Should equal 100\",\"id\":\"total\",\"formtype\":\"d06\",\"name\":\"total\",\"type\":\"number\",\"required\":\"true\",\"min\":\"100\",\"max\":\"100\",\"calculations\":[\"past_advisor_pct\",\"Plus\",\"past_assoc_mem\",\"Plus\",\"past_equipment\",\"Plus\",\"past_human_resources\",\"Plus\",\"past_inventory\",\"Plus\",\"past_marketing_promotion\",\"Plus\",\"past_office_supplies\",\"Plus\",\"past_rent\",\"Plus\",\"past_security\",\"Plus\",\"past_tenant_improvements\",\"Plus\",\"past_other_pct\"]},{\"label\":\"How will you spend the grant?\",\"id\":\"page_separator_7\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Advisor (like financial, legal)\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_advisor\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_advisor\"},{\"label\":\"Associate membership\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_associate_membership\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_associate_membership\"},{\"label\":\"Equipment\\/technology\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_equipment\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_equipment\"},{\"label\":\"Facade improvements\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_facade_improvements\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_facade_improvements\"},{\"label\":\"Human resources\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_human_resources\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_human_resources\"},{\"label\":\"Inventory\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_inventory\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_inventory\"},{\"label\":\"Marketing\\/promotion\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_marketing\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_marketing\"},{\"label\":\"Office supplies\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_office_supplies\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_office_supplies\"},{\"label\":\"Rent\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_rent\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_rent\"},{\"label\":\"Security\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_security\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_security\"},{\"label\":\"Tenant improvements (like business improvements)\",\"placeholder\":\"\",\"help\":\"Proposed % of budget\",\"id\":\"future_tenant_improvements\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_tenant_improvements\"},{\"label\":\"Other\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_other\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_other\"},{\"label\":\"Total\",\"placeholder\":\"\",\"help\":\"Should equal 100%\",\"id\":\"total_2\",\"formtype\":\"d06\",\"name\":\"total_2\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"past_advisor_pct\",\"Plus\",\"past_assoc_mem\",\"Plus\",\"past_equipment\",\"Plus\",\"past_tenant_improvements\",\"Plus\",\"past_human_resources\",\"Plus\",\"past_inventory\",\"Plus\",\"past_marketing_promotion\",\"Plus\",\"past_office_supplies\",\"Plus\",\"past_rent\",\"Plus\",\"past_security\",\"Plus\",\"past_tenant_improvements\",\"Plus\",\"past_other_pct\"],\"value\":\"100\",\"min\":\"100\",\"max\":\"100\"},{\"label\":\"Other grants from the City\",\"id\":\"page_separator_4\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Have you received or applied for any business stabilization grants from the City within the last 3 years?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"received_grant\",\"formtype\":\"s08\",\"value\":\"yes\",\"name\":\"received_grant\",\"required\":\"true\"},{\"label\":\"What was the name of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_name\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"grant_name\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"What was the amount of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_amount\",\"formtype\":\"d08\",\"name\":\"grant_amount\",\"type\":\"number\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"When was the start date of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_start_date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\",\"name\":\"grant_start_date\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"When was the end date of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_end_date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\",\"name\":\"grant_end_date\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Is your business registered as a City Supplier?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"city_supplier\",\"formtype\":\"s08\",\"name\":\"city_supplier\",\"required\":\"true\"},{\"label\":\"What is your Supplier ID (if known)?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_1\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"city_supplier\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Is your business registered as a Bidder with the City and County of San Francisco?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"bidder\",\"formtype\":\"s08\",\"required\":\"true\",\"name\":\"bidder\"},{\"label\":\"What is your Bidder ID (if known)?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"bidder_id\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"bidder_id\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"bidder\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"textarea\":\"You should register as a Bidder so that you can supply the city\",\"id\":\"register_as_bidder\",\"formtype\":\"m08\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"bidder\",\"op\":\"matches\",\"val\":\"No\"}]}},{\"label\":\"\",\"checkboxes\":[\"\",\"\",\"\",\"\",\"I declare under penalty of perjury that the information I am submitting is true and correct. If I give false or incomplete information the Office of Small Business can deny my Legacy Business grant request or revoke my grant.\",\"\",\"\",\"\",\"I understand that my grant application is void or revoked if my company owes money to the City and County of San Francisco.\",\"\",\"\",\"\",\"I understand that my grant application is void or revoked if my company has any current determinations or violations of any of the City labor laws.\",\"\",\"\",\"\",\"I understand that my grant application is void or revoked if my business owes any penalties or payments to the Office of Labor Standards Enforcement.\",\"\",\"  \"],\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"Agreements\",\"id\":\"page_separator_5\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Upload supporting docs\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\",\"name\":\"supporting_docs\"},{\"button\":\"Submit\",\"id\":\"button\",\"formtype\":\"m14\",\"color\":\"btn-success\"}]}','2019-02-12 22:19:19','2019-05-29 00:55:17',NULL),(62,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"Accessory Dwelling Unit Screening Form\"},\"data\":[{\"label\":\"Which ordinance are you applying under?\",\"radios\":[\"162-16\",\"96-17\",\"162-17\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\",\"name\":\"ordinance\"},{\"textarea\":\"Section 1 and 3 of the screening form shall be completed by the owner or agent to determine the eligibility for adding dwelling units per Ordinance No. 162-16 based on permits for Mandatory Seismic Retrofitting under SFEBC Chapter 4D, or voluntary seismic retrofitting per AB-094, or existing residential building complies with the requirements of Ordinance No. 162-16, No. 95-17 or No. 162-17.\",\"id\":\"paragraph\",\"formtype\":\"m08\"},{\"label\":\"Block Number\",\"placeholder\":\"placeholder\",\"help\":\"Block number of property\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Lot Number\",\"placeholder\":\"placeholder\",\"help\":\"Lot Number of the Property\",\"id\":\"text_input_1\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address\",\"placeholder\":\"placeholder\",\"help\":\"Address of the property\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact:\",\"radios\":[\"Owner\",\"Agent\"],\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"Administrative Information\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Contact Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Contact Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Contact Street Address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address_1\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact City\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"city\",\"formtype\":\"c10\",\"name\":\"city\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact Zip\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"number\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Owner Affadavit - Housing Services\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"type\":\"text\"}]}','2019-02-14 01:24:54','2019-04-08 20:00:39',NULL),(72,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Clone of Accessory Dwelling Unit Screening Form\"},\"data\":[{\"codearea\":\"This is a &lt;a href=https://sfosb.org/sites/default/files/Legacy%20Business/Business%20Assistance%20Grant%20FTE%20Worksheet%202018-19_0.xlsx&gt; worksheet&lt;/a&gt;\",\"id\":\"paragraph_5\",\"formtype\":\"m10\"},{\"label\":\"Which ordinance are you applying under?\",\"radios\":\"162-16\\n96-17\\n162-17\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"textarea\":\"Section 1 and 3 of the screening form shall be completed by the owner or agent to determine the eligibility for adding dwelling units per Ordinance No. 162-16 based on permits for Mandatory Seismic Retrofitting under SFEBC Chapter 4D, or voluntary seismic retrofitting per AB-094, or existing residential building complies with the requirements of Ordinance No. 162-16, No. 95-17 or No. 162-17.\",\"id\":\"paragraph\",\"formtype\":\"m08\"},{\"label\":\"Block Number\",\"placeholder\":\"placeholder\",\"help\":\"Block number of property\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Lot Number\",\"placeholder\":\"placeholder\",\"help\":\"Lot Number of the Property\",\"id\":\"text_input_1\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address\",\"placeholder\":\"placeholder\",\"help\":\"Address of the property\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact:\",\"radios\":\"Owner\\nAgent\",\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"Administrative Information\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Contact Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Contact Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Contact Street Address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address_1\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact City\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"city\",\"formtype\":\"c10\",\"name\":\"city\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact Zip\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"number\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Owner Affadavit - Housing Services\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"type\":\"text\"},{\"textarea\":\"Owner(s) acknowledges that pursuant to Rent Ordinance 37.2(r) severance of garage facilities, parking facilities, driveways, storage space, laundry rooms, decks, patios, and gardens on the same lot, or kitchen facilities and lobbies within an SRO from an existing tenancy requires a just cause”. The issuance of a permit does not constitute a just cause. A signature below asserts that the Owner(s) is aware of these legal requirements and is proceeding with filing a permit to convert existing space within their building into an Accessory Dwelling Unit(s), or owner signature asserts that property is not subject to these controls in Rent Ordinance or project does not propose removal of housing services, therefore B &amp; C as described below, not required as part of Screening Form process.\",\"id\":\"paragraph_1\",\"formtype\":\"m08\"},{\"label\":\"Printed Name of Owner\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_2\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Signature\",\"textarea\":\" \",\"id\":\"textarea\",\"formtype\":\"i14\",\"required\":\"true\"},{\"label\":\"Date\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"textarea\":\"AND Owner must notify affected tenants of the Owner(s) intention to convert aforementioned space(s) to Accessory Dwelling Unit(s)\",\"id\":\"paragraph_2\",\"formtype\":\"m08\"},{\"codearea\":\"&lt;ol&gt;&lt;li&gt;Notice to be posted for 15-days in a common area of the building; and&lt;/li&gt;&lt;li&gt;Notice to be mailed to all tenants and to property owner.&lt;/li&gt;&lt;/ol&gt;\",\"id\":\"paragraph_4\",\"formtype\":\"m10\"},{\"textarea\":\"AND Submit copy of posted/mailed notice, postmarked letter to owner, photograph of posted notice, and copy of mailing list with this Screening Form. \",\"id\":\"paragraph_3\",\"formtype\":\"m08\"},{\"label\":\"Determination of Eligibility to add dwelling units\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Has mandatory seismic retrofitting been filed under SFEBC Chapter 4D, Mandatory Earthquake Retrofit of Wood Frame Buildings?\",\"radios\":\"Yes\\nNo\",\"id\":\"mandatory_seismic_radios\",\"formtype\":\"s08\",\"value\":\"No\",\"required\":\"true\"},{\"label\":\" Permit Application Number:\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"seismic permit number\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Has voluntary seismic strengthening been filed under Administrative Bulletin AB-094, Definition and Design Criteria for Voluntary Seismic Upgrade of Soft Story, Type-V (wood frame) Buildings?\",\"radios\":\"Yes\\nNo\",\"id\":\"voluntary_seismic_radios\",\"formtype\":\"s08\",\"value\":\"No\",\"required\":\"true\"},{\"label\":\"Permit Application Number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"voluntary_seismic_permit_number\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Does existing residential building comply with Ordinance No. 162-16, No. 95-17 or 162-17 for addition of dwelling units? (Subject to Planning review)\",\"radios\":\"Yes\\nNo\",\"id\":\"multiple_radios_2\",\"formtype\":\"s08\",\"value\":\"No\",\"required\":\"true\"},{\"label\":\"Owner/Agent\",\"placeholder\":\"signature\",\"help\":\"Sign here\",\"id\":\"name_1\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Date\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"date_1\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Owner or Agent?\",\"radios\":\"Owner\\nAgent\",\"id\":\"multiple_radios_3\",\"formtype\":\"s08\",\"required\":\"true\"}]}','2019-02-14 01:57:41','2019-02-15 20:29:12',NULL),(112,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Clone of Clone of Accessory Dwelling Unit Screening Form\"},\"data\":[{\"codearea\":\"This is a &lt;a href=https:\\/\\/sfosb.org\\/sites\\/default\\/files\\/Legacy%20Business\\/Business%20Assistance%20Grant%20FTE%20Worksheet%202018-19_0.xlsx&gt; worksheet&lt;\\/a&gt;\",\"id\":\"paragraph_5\",\"formtype\":\"m10\"},{\"label\":\"Which ordinance are you applying under?\",\"radios\":\"162-16\\n96-17\\n162-17\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"required\":\"true\"},{\"textarea\":\"Section 1 and 3 of the screening form shall be completed by the owner or agent to determine the eligibility for adding dwelling units per Ordinance No. 162-16 based on permits for Mandatory Seismic Retrofitting under SFEBC Chapter 4D, or voluntary seismic retrofitting per AB-094, or existing residential building complies with the requirements of Ordinance No. 162-16, No. 95-17 or No. 162-17.\",\"id\":\"paragraph\",\"formtype\":\"m08\"},{\"label\":\"Block Number\",\"placeholder\":\"placeholder\",\"help\":\"Block number of property\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Lot Number\",\"placeholder\":\"placeholder\",\"help\":\"Lot Number of the Property\",\"id\":\"text_input_1\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address\",\"placeholder\":\"placeholder\",\"help\":\"Address of the property\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact:\",\"radios\":\"Owner\\nAgent\",\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"required\":\"true\"},{\"label\":\"Administrative Information\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Contact Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Contact Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Contact Street Address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address_1\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact City\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"city\",\"formtype\":\"c10\",\"name\":\"city\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Contact Zip\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"number\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Owner Affadavit - Housing Services\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"type\":\"text\"},{\"textarea\":\"Owner(s) acknowledges that pursuant to Rent Ordinance 37.2(r) severance of garage facilities, parking facilities, driveways, storage space, laundry rooms, decks, patios, and gardens on the same lot, or kitchen facilities and lobbies within an SRO from an existing tenancy requires a just cause\\u201d. The issuance of a permit does not constitute a just cause. A signature below asserts that the Owner(s) is aware of these legal requirements and is proceeding with filing a permit to convert existing space within their building into an Accessory Dwelling Unit(s), or owner signature asserts that property is not subject to these controls in Rent Ordinance or project does not propose removal of housing services, therefore B &amp; C as described below, not required as part of Screening Form process.\",\"id\":\"paragraph_1\",\"formtype\":\"m08\"},{\"label\":\"Printed Name of Owner\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_2\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Signature\",\"textarea\":\" \",\"id\":\"textarea\",\"formtype\":\"i14\",\"required\":\"true\"},{\"label\":\"Date\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"textarea\":\"AND Owner must notify affected tenants of the Owner(s) intention to convert aforementioned space(s) to Accessory Dwelling Unit(s)\",\"id\":\"paragraph_2\",\"formtype\":\"m08\"},{\"codearea\":\"&lt;ol&gt;&lt;li&gt;Notice to be posted for 15-days in a common area of the building; and&lt;\\/li&gt;&lt;li&gt;Notice to be mailed to all tenants and to property owner.&lt;\\/li&gt;&lt;\\/ol&gt;\",\"id\":\"paragraph_4\",\"formtype\":\"m10\"},{\"textarea\":\"AND Submit copy of posted\\/mailed notice, postmarked letter to owner, photograph of posted notice, and copy of mailing list with this Screening Form. \",\"id\":\"paragraph_3\",\"formtype\":\"m08\"},{\"label\":\"Determination of Eligibility to add dwelling units\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Has mandatory seismic retrofitting been filed under SFEBC Chapter 4D, Mandatory Earthquake Retrofit of Wood Frame Buildings?\",\"radios\":\"Yes\\nNo\",\"id\":\"mandatory_seismic_radios\",\"formtype\":\"s08\",\"value\":\"No\",\"required\":\"true\"},{\"label\":\" Permit Application Number:\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"seismic permit number\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Has voluntary seismic strengthening been filed under Administrative Bulletin AB-094, Definition and Design Criteria for Voluntary Seismic Upgrade of Soft Story, Type-V (wood frame) Buildings?\",\"radios\":\"Yes\\nNo\",\"id\":\"voluntary_seismic_radios\",\"formtype\":\"s08\",\"value\":\"No\",\"required\":\"true\"},{\"label\":\"Permit Application Number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"voluntary_seismic_permit_number\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Does existing residential building comply with Ordinance No. 162-16, No. 95-17 or 162-17 for addition of dwelling units? (Subject to Planning review)\",\"radios\":\"Yes\\nNo\",\"id\":\"multiple_radios_2\",\"formtype\":\"s08\",\"value\":\"No\",\"required\":\"true\"},{\"label\":\"Owner\\/Agent\",\"placeholder\":\"signature\",\"help\":\"Sign here\",\"id\":\"name_1\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Date\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"date_1\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Owner or Agent?\",\"radios\":\"Owner\\nAgent\",\"id\":\"multiple_radios_3\",\"formtype\":\"s08\",\"required\":\"true\"}]}','2019-02-16 00:36:31','2019-02-16 00:36:31',NULL),(392,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"Clone 2 of Apply for a Legacy Business grant\"},\"data\":[{\"label\":\"Contact information\",\"id\":\"page_separator_9\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"Like name@email.com\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Business information\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"How many locations does your business have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"number_locations\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"number_locations\"},{\"label\":\"Your business name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_name\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_name\"},{\"label\":\"Location 1 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_1\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_1\"},{\"label\":\"Location 1 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_1\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_1\"},{\"label\":\"Location 1 state\",\"placeholder\":\"placeholder\",\"help\":\"\",\"id\":\"business_state_1\",\"formtype\":\"s15\",\"name\":\"business_state_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Location 1 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_1\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_1\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 2 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_2\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_2\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]}},{\"label\":\"Location 2 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_2\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_2\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]}},{\"label\":\"Location 2 state\",\"placeholder\":\"placeholder\",\"help\":\"\",\"id\":\"business_state_2\",\"formtype\":\"s15\",\"name\":\"business_state_2\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]}},{\"label\":\"Location 2 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_2\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_2\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"1\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 3 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_3\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_3\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]}},{\"label\":\"Location 3 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_3\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_3\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]}},{\"label\":\"Location 3 state\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_state_3\",\"formtype\":\"s15\",\"name\":\"business_state_3\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]}},{\"label\":\"Location 3 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_3\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_3\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"2\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 4 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_4\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_4\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]}},{\"label\":\"Location 4 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_4\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_4\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]}},{\"label\":\"Location 4 state\",\"placeholder\":\"placeholder\",\"help\":\"\",\"id\":\"business_state_4\",\"formtype\":\"s15\",\"name\":\"business_state_4\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]}},{\"label\":\"Location 4 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"3\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Location 5 address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_address_5\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_address_5\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]}},{\"label\":\"Location 5 city\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_city_5\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"business_city_5\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]}},{\"label\":\"Location 5 state\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"business_state_5\",\"formtype\":\"s15\",\"name\":\"business_state_5\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]}},{\"label\":\"Location 5 zip code\",\"placeholder\":\"\",\"help\":\"Like 94103\",\"id\":\"business_zip_5\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"business_zip_5\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"number_locations\",\"op\":\"is more than\",\"val\":\"4\"}]},\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Rent or mortgage to gross revenue\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"How much did your business spend on rent during 2017?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"spend_2017\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\",\"name\":\"spend_2017\"},{\"label\":\"How much did your business earn in terms of gross revenue in 2017?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"gross_revenue_2017\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\",\"name\":\"gross_revenue_2017\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden_100\",\"formtype\":\"m11\",\"type\":\"text\",\"value\":\"100\",\"name\":\"hidden_100\"},{\"label\":\"Percent of rent or mortgage that is gross\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"percent_rent_mortgage\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"percent_rent_mortgage\",\"calculations\":[\"spend_2017\",\"Divided by\",\"gross_revenue_2017\",\"Multiplied by\",\"hidden_100\"]},{\"label\":\"Business Closure\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Was your business closed at any time from July 1, 2017 to June 30, 2018?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"business_closure\",\"formtype\":\"s08\",\"value\":\"yes\",\"name\":\"business_closure\",\"required\":\"true\"},{\"label\":\"When did your business close?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"close_date\",\"formtype\":\"d02\",\"name\":\"close_date\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"When did your business reopen?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"reopen_date\",\"formtype\":\"d02\",\"name\":\"reopen_date\",\"type\":\"date\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"business_closure\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Date\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Which location was closed?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"closed_address\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"closed_address\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"business_closure\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"What was the reason this location was closed?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"reason_closed\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"reason_closed\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"business_closure\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Employees\",\"id\":\"page_separator_3\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"How many full-time employees did you employ between July 1, 2017 to June 30, 2018?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"num_fte\",\"formtype\":\"d06\",\"name\":\"num_fte\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden_500\",\"formtype\":\"m11\",\"type\":\"text\",\"value\":\"500\",\"name\":\"hidden_500\"},{\"label\":\"How much money are you asking for?\",\"placeholder\":\"\",\"help\":\"You can ask up to $500 for every full-time employee up to a total of $50,000\",\"id\":\"how_much_money\",\"formtype\":\"d08\",\"name\":\"how_much_money\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"num_fte\",\"Multiplied by\",\"hidden_500\"]},{\"label\":\"Upload Business Assistance Grant FTE Worksheet 2019-2020\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"Upload Verification of FTEs for the fiscal year (July 1, 2018 to June 30, 2019). Payroll reports are preferred.\",\"id\":\"file_upload_1\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"How did you spend last years grant?\",\"id\":\"page_separator_6\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Advisor (like financial, legal)\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_advisor_pct\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_advisor_pct\"},{\"label\":\"Associate membership\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_assoc_mem\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_assoc_mem\"},{\"label\":\"Equipment\\/technology\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_equipment\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_equipment\"},{\"label\":\"Human resources\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_human_resources\",\"formtype\":\"d06\",\"name\":\"past_human_resources\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Inventory\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_inventory\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_inventory\"},{\"label\":\"Marketing\\/ promotion\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_marketing_promotion\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_marketing_promotion\"},{\"label\":\"Office supplies\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_office_supplies\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_office_supplies\"},{\"label\":\"Rent\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_rent\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_rent\"},{\"label\":\"Security\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_security\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_security\"},{\"label\":\"Tenant improvements (like business improvements)\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_tenant_improvements\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_tenant_improvements\"},{\"label\":\"Other\",\"placeholder\":\"\",\"help\":\"% of grant allocated for\",\"id\":\"past_other_pct\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"past_other_pct\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden_100b\",\"formtype\":\"m11\",\"type\":\"text\",\"value\":\"100\",\"name\":\"hidden_100b\"},{\"label\":\"Total\",\"placeholder\":\"\",\"help\":\"Should equal 100\",\"id\":\"total\",\"formtype\":\"d06\",\"name\":\"total\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"past_advisor_pct\",\"Plus\",\"past_assoc_mem\",\"Plus\",\"past_equipment\",\"Plus\",\"past_human_resources\",\"Plus\",\"past_inventory\",\"Plus\",\"past_marketing_promotion\",\"Plus\",\"past_office_supplies\",\"Plus\",\"past_rent\",\"Plus\",\"past_security\",\"Plus\",\"past_tenant_improvements\",\"Plus\",\"past_other_pct\"]},{\"label\":\"How will you spend the grant?\",\"id\":\"page_separator_7\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Advisor (like financial, legal)\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_advisor\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_advisor\"},{\"label\":\"Associate membership\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_associate_membership\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_associate_membership\"},{\"label\":\"Equipment\\/technology\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_equipment\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_equipment\"},{\"label\":\"Facade improvements\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_facade_improvements\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_facade_improvements\"},{\"label\":\"Human resources\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_human_resources\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_human_resources\"},{\"label\":\"Inventory\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_inventory\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_inventory\"},{\"label\":\"Marketing\\/promotion\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_marketing\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_marketing\"},{\"label\":\"Office supplies\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_office_supplies\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_office_supplies\"},{\"label\":\"Rent\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_rent\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_rent\"},{\"label\":\"Security\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_security\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_security\"},{\"label\":\"Tenant improvements (like business improvements)\",\"placeholder\":\"\",\"help\":\"Proposed % of budget\",\"id\":\"future_tenant_improvements\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_tenant_improvements\"},{\"label\":\"Other\",\"placeholder\":\"\",\"help\":\"Proposed % of grant\",\"id\":\"future_other\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"future_other\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden_100c\",\"formtype\":\"m11\",\"type\":\"text\",\"value\":\"100\",\"name\":\"hidden_100c\"},{\"label\":\"Total\",\"placeholder\":\"\",\"help\":\"Should equal 100%\",\"id\":\"total_2\",\"formtype\":\"d06\",\"name\":\"total_2\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"past_advisor_pct\",\"Plus\",\"past_assoc_mem\",\"Plus\",\"past_equipment\",\"Plus\",\"past_tenant_improvements\",\"Plus\",\"past_human_resources\",\"Plus\",\"past_inventory\",\"Plus\",\"past_marketing_promotion\",\"Plus\",\"past_office_supplies\",\"Plus\",\"past_rent\",\"Plus\",\"past_security\",\"Plus\",\"past_tenant_improvements\",\"Plus\",\"past_other_pct\"]},{\"label\":\"Upload verification of how last year&amp;apos;s grant funds (FY 2018-2019) were spent.  Include invoices, copies or checks or receipts.\",\"id\":\"file_upload_3\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"Other grants from the City\",\"id\":\"page_separator_4\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Have you received or applied for any business stabilization grants from the City within the last 3 years?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"received_grant\",\"formtype\":\"s08\",\"value\":\"yes\",\"name\":\"received_grant\",\"required\":\"true\"},{\"label\":\"What was the name of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_name\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"grant_name\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"What was the amount of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_amount\",\"formtype\":\"d08\",\"name\":\"grant_amount\",\"type\":\"number\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"When was the start date of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_start_date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\",\"name\":\"grant_start_date\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"When was the end date of the grant?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"grant_end_date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\",\"name\":\"grant_end_date\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"received_grant\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Is your business registered as a City Supplier?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"city_supplier\",\"formtype\":\"s08\",\"required\":\"true\",\"name\":\"city_supplier\"},{\"label\":\"What is your Supplier ID (if known)?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_1\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"city_supplier\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Is your business registered as a Bidder with the City and County of San Francisco?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"bidder\",\"formtype\":\"s08\",\"required\":\"true\",\"name\":\"bidder\"},{\"label\":\"What is your Bidder ID (if known)?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"bidder_id\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"bidder_id\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"bidder\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"textarea\":\"You should register as a Bidder so that you can supply the city\",\"id\":\"register_as_bidder\",\"formtype\":\"m08\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"bidder\",\"op\":\"matches\",\"val\":\"No\"}]}},{\"label\":\"Agreements\",\"id\":\"page_separator_5\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"\",\"checkboxes\":[\"I declare under penalty of perjury that the information I am submitting is true and correct. If I give false or incomplete information the Office of Small Business can deny my Legacy Business grant request or revoke my grant.\",\"I understand that my grant application is void or revoked if my company owes money to the City and County of San Francisco.\",\"I understand that my grant application is void or revoked if my company has any current determinations or violations of any of the City labor laws.\",\"I understand that my grant application is void or revoked if my business owes any penalties or payments to the Office of Labor Standards Enforcement.\"],\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"required\":\"false\"},{\"button\":\"Submit\",\"id\":\"button\",\"formtype\":\"m14\",\"color\":\"btn-success\"}]}','2019-04-04 21:36:28','2019-04-05 00:40:26',NULL),(402,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Kitchen Sink\",\"backend\":\"db\",\"section1\":\"Free-text fields\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Calc 1\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_1\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"value\":\"1\"},{\"label\":\"Calc 2\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_2\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"value\":\"2\"},{\"label\":\"Calc Result\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_3\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"numbers_1\",\"Plus\",\"numbers_2\"]},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"name\",\"op\":\"contains anything\",\"val\":\"\"}]}},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Text Content, File, Hidden, Price, Select, Checkboxes, State\",\"id\":\"page_separator_3\",\"formtype\":\"m16\",\"type\":\"text\"},{\"textarea\":\"H1 Header Text\",\"id\":\"name_1\",\"formtype\":\"m02\",\"type\":\"text\"},{\"textarea\":\"H2 Header Text\",\"id\":\"name_2\",\"formtype\":\"m04\",\"type\":\"text\"},{\"textarea\":\"This is a block of text in a paragraph\",\"id\":\"paragraph_2\",\"formtype\":\"m08\"},{\"textarea\":\"H3 Header Text\",\"id\":\"name_3\",\"formtype\":\"m06\",\"type\":\"text\"},{\"codearea\":\"This is a block of text with HTML content\",\"id\":\"paragraph_1\",\"formtype\":\"m10\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden_1\",\"formtype\":\"m11\",\"type\":\"text\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden\",\"formtype\":\"m11\",\"type\":\"text\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\"},{\"textarea\":\"This is a block of text in a paragraph\",\"id\":\"paragraph\",\"formtype\":\"m08\"},{\"label\":\"Price\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"price\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Select - Basic\",\"option\":[\"Enter\",\"Your\",\"Options\",\"Here!\"],\"id\":\"select_dropdown\",\"formtype\":\"s02\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":[\"Here is one option\",\"Here is another\"],\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"required\":\"false\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names\",\"id\":\"state\",\"formtype\":\"s14\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names, abbr value\",\"id\":\"state_1\",\"formtype\":\"s15\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State, Radio, Textarea, URL, Password\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Abbreviated\",\"id\":\"state_2\",\"formtype\":\"s16\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"Textarea\",\"textarea\":\" \",\"id\":\"textarea\",\"formtype\":\"i14\",\"required\":\"true\"},{\"label\":\"URL\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"url\",\"formtype\":\"d10\",\"type\":\"url\",\"required\":\"true\"},{\"label\":\"Password\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"password\",\"formtype\":\"d12\",\"name\":\"password\",\"type\":\"password\",\"required\":\"true\",\"minlength\":\"6\"},{\"label\":\"Numbers, Time, Text, Search\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Time\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"time\",\"formtype\":\"d04\",\"type\":\"time\",\"required\":\"true\"},{\"label\":\"Text input\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"3\",\"maxlength\":\"5\"},{\"label\":\"Search input\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"search_input\",\"formtype\":\"i04\",\"type\":\"search\",\"required\":\"true\"},{\"label\":\"Date, Address, City, Zip\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Date\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Address\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"City\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"city\",\"formtype\":\"c10\",\"name\":\"city\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Zip\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"number\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-07 21:46:17','2019-05-13 15:55:57',NULL),(522,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"division\"},\"data\":[{\"label\":\"Number\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_1\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Divided by...\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_2\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Equals\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"numbers_1\",\"Divided by\",\"numbers_2\"]},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-17 23:55:33','2019-04-17 23:57:21',NULL),(632,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Simple Form\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"What is your answer for Q1?\",\"radios\":[\"yes\",\"no\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"What is Q2?\",\"radios\":[\"no\",\"yes\"],\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-22 19:35:31','2019-04-22 19:58:28',NULL),(652,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"test error messages\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/google.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\",\"maxlength\":\"10\"},{\"label\":\"Zip\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-23 16:57:51','2019-04-23 18:48:32',NULL),(772,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging-pr-67.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"test 291\",\"backend\":\"csv\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-25 22:11:16','2019-04-25 22:11:24',NULL),(782,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging-pr-67.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"test 291\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/facebook.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\",\"name\":\"Upload File\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-25 22:13:58','2019-04-25 22:17:53',NULL),(812,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging-pr-67.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"test 291(b)\",\"backend\":\"csv\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\",\"name\":\"test\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-25 22:33:40','2019-04-25 22:35:17',NULL),(842,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"Test form Bunny\",\"backend\":\"csv\",\"confirmation\":\"http:\\/\\/wired.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"true\",\"name\":\"brians_form\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-26 23:15:32','2019-04-26 23:17:19',NULL),(852,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB 182\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Stark\",\"Targaryean\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-29 17:41:25','2019-04-29 17:43:36',NULL),(862,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-234 QA\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden\",\"formtype\":\"m11\",\"type\":\"hidden\",\"value\":\"100\",\"name\":\"hidden_num\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"name\":\"Numbers\",\"min\":\"100\",\"max\":\"100\"},{\"label\":\"Text input\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"numbers\",\"op\":\"matches\",\"val\":\"100\"}]}},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-29 17:50:46','2019-04-29 17:57:18',NULL),(872,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-174\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Date\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"URL\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"url\",\"formtype\":\"d10\",\"type\":\"url\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-29 18:05:52','2019-04-29 18:08:19',NULL),(882,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-306\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden\",\"formtype\":\"m11\",\"type\":\"hidden\",\"value\":\"10\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-29 18:22:27','2019-04-29 18:24:31',NULL),(892,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"HSA- Request for Leave and Leave Protections\"},\"data\":[{\"label\":\"What is the status of your request?\",\"radios\":[\"New request\",\"Request for extension\"],\"id\":\"extension_type\",\"formtype\":\"s08\",\"name\":\"extension_type\",\"required\":\"true\",\"textarea\":\"Requests for extension leave must be submitted 2 weeks before the end of the currently scheduled leave when practical. Failure to submit within the 2-week timeframe may delay the extension being granted.\"},{\"textarea\":\"Requests for extension leave must be submitted 2 weeks before the end of the currently scheduled leave when practical.\",\"id\":\"extension_text\",\"formtype\":\"m08\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"extension_type\",\"op\":\"matches\",\"val\":\"Request for extension\"}]}},{\"label\":\"DSW#\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"dsw\",\"formtype\":\"c02\",\"name\":\"dsw\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Class or Title\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"class_title\",\"formtype\":\"d06\",\"type\":\"text\",\"required\":\"true\",\"name\":\"class_title\"},{\"label\":\"Text input\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"City\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"city\",\"formtype\":\"c10\",\"name\":\"city\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"name\":\"page_separator\",\"type\":\"text\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names, abbr value\",\"id\":\"state\",\"formtype\":\"s15\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Zip\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Department\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"department\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"department\"},{\"label\":\"Supervisor\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"supervisor\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"supervisor\"},{\"label\":\"Employment status\",\"checkboxes\":[\"Permanent\",\"Probationary\",\"Exempt\",\"Temporary\",\"Provisional\"],\"id\":\"employment_status\",\"formtype\":\"s06\",\"required\":\"false\",\"name\":\"employment_status\"}]}','2019-04-29 20:04:00','2019-08-15 21:55:39',NULL),(952,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"df values\"},\"data\":[{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-04-30 20:56:16','2019-04-30 21:01:26',NULL),(1082,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"test form 311\",\"backend\":\"csv\",\"confirmation\":\"http:\\/\\/wsj.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"false\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"false\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-05-07 21:52:05','2019-05-07 21:56:06',NULL),(1092,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"test form DFB-310\",\"backend\":\"csv\",\"confirmation\":\"http:\\/\\/wired.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Do you like watches\",\"radios\":[\"Yes\",\"No\"],\"id\":\"like_watches\",\"formtype\":\"s08\",\"name\":\"like_watches\",\"required\":\"true\"},{\"textarea\":\"This is a block of text in a paragraph\",\"id\":\"paragraph_text\",\"formtype\":\"m08\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"like_watches\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"type\":\"file\",\"required\":\"false\",\"name\":\"hey_you\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-05-13 17:41:09','2019-05-13 18:06:21',NULL),(1102,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Cannabis\"},\"data\":[{\"label\":\"What is your authorization to apply?\",\"checkboxes\":[\"I am an Equity Applicant\",\"My business is an Equity Incubator\",\"I registered my business with the Office of Cannabis and have signed an affidavit\",\"I have a temporary cannabis permit\",\"I have a Medical Cannabis Dispensary (MCD) permit or applied for one before September 26, 2017\",\"I ran a cannabis business that was previously shut down by federal authorities\"],\"id\":\"can_you_apply\",\"formtype\":\"s06\",\"name\":\"can_you_apply\",\"required\":\"false\"},{\"label\":\"What is your MCD permit number?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"MCD_permit_num\",\"formtype\":\"i02\",\"name\":\"MCD_permit_num\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"can_you_apply\",\"op\":\"matches\",\"val\":\"I ran a cannabis business that was previously shut down by federal authorities\"}]}},{\"textarea\":\"This is a block of text in a paragraph\",\"id\":\"block\",\"formtype\":\"m08\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":\"All\",\"condition\":[{\"id\":\"can_you_apply\",\"op\":\"contains\",\"val\":\"am\"},{\"id\":\"can_you_apply\",\"op\":\"contains\",\"val\":\"Incubator\"}]}}]}','2019-05-13 18:42:54','2019-05-13 19:11:32',NULL),(1112,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"313\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-05-14 00:00:41','2019-05-14 00:00:47',NULL),(1122,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"238\",\"backend\":\"csv\",\"confirmation\":\"http:\\/\\/therake.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name_1\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\",\"match\":\"name\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-05-14 00:30:00','2019-05-14 00:32:09',NULL),(1142,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"DFB-314\",\"backend\":\"csv\",\"confirmation\":\"http:\\/\\/google.com\"},\"data\":[{\"label\":\"Numbers\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers\",\"formtype\":\"d06\",\"name\":\"numbers\",\"type\":\"number\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-05-21 16:36:36','2019-05-21 16:49:05',NULL),(1312,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Kitchen Sink II: The Revenge\"},\"data\":[{\"textarea\":\"H2 Header Text\",\"id\":\"name_2\",\"formtype\":\"m04\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"textarea\":\"This is a block of text in a paragraph\",\"id\":\"paragraph_text\",\"formtype\":\"m08\"},{\"codearea\":\"This is a block of text with HTML content\",\"id\":\"paragraph_html\",\"formtype\":\"m10\"},{\"textarea\":\"H3 Header Text\",\"id\":\"name_3\",\"formtype\":\"m06\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"[Hidden Form Element]\",\"hidden\":\"\",\"id\":\"hidden\",\"formtype\":\"m11\",\"type\":\"hidden\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"name\":\"file_upload\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"Select - Basic\",\"option\":[\"Enter\",\"Your\",\"Options\",\"Here!\"],\"id\":\"select_dropdown\",\"formtype\":\"s02\",\"required\":\"true\"},{\"textarea\":\"H1 Header Text\",\"id\":\"name_1\",\"formtype\":\"m02\",\"type\":\"text\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names\",\"id\":\"state_1\",\"formtype\":\"s14\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Abbreviated\",\"id\":\"state_2\",\"formtype\":\"s16\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Text input\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"State\",\"placeholder\":\"placeholder\",\"help\":\"Full names, abbr value\",\"id\":\"state\",\"formtype\":\"s15\",\"name\":\"state\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"Time\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"time\",\"formtype\":\"d04\",\"type\":\"time\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Textarea\",\"textarea\":\" \",\"id\":\"textarea\",\"formtype\":\"i14\",\"required\":\"true\"},{\"label\":\"Date\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Price\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"price\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"URL\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"url\",\"formtype\":\"d10\",\"type\":\"url\",\"required\":\"true\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"type\":\"text\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Zip\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"City\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"city\",\"formtype\":\"c10\",\"name\":\"city\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-05-29 19:42:57','2019-05-29 19:43:38',NULL),(1332,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-304\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-06-03 21:58:57','2019-06-03 22:43:13',NULL),(1352,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-245\"},\"data\":[{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_1\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_2\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers_3\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"calculations\":[\"numbers_1\",\"Plus\",\"numbers_2\"]},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-06-03 22:29:01','2019-06-03 22:29:53',NULL),(1372,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-300\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Who makes watches for watchmakers?\",\"radios\":[\"Patek\",\"Jaegar LeCoultre\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"name\":\"file_upload\",\"type\":\"file\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-06-03 22:36:33','2019-06-03 22:37:29',NULL),(1412,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"DFB-315\",\"backend\":\"csv\",\"confirmation\":\"http:\\/\\/google.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Are you a new MFF?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"new_mff\",\"formtype\":\"s08\",\"name\":\"new_mff\",\"required\":\"true\"},{\"label\":\"How will you be operating?\",\"radios\":[\"Private Property\",\"Public right of way\",\"Both\"],\"id\":\"operating\",\"formtype\":\"s08\",\"name\":\"operating\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"new_mff\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\",\"max\":\"500\"},{\"label\":\"Upload supporting documents\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"name\":\"file_upload\",\"type\":\"file\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"new_mff\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-06-12 18:08:42','2019-06-18 17:36:26',NULL),(1472,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-368\"},\"data\":[{\"label\":\"Your Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Do you have an email?\",\"radios\":[\"Yes\",\"No\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"multiple_radios\",\"op\":\"matches\",\"val\":\"Yes\"}]}},{\"label\":\"Cobra Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\"}]}','2019-06-26 16:53:50','2019-06-26 16:58:25',NULL),(1512,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-367\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-01 17:13:15','2019-07-01 17:13:23',NULL),(1522,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"new form B\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\",\"Option three\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-01 17:28:37','2019-07-01 17:32:35',NULL),(1552,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-377\"},\"data\":[]}','2019-07-01 17:54:46','2019-07-01 17:54:46',NULL),(1562,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-377\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"chicken\",\"fish2\",\"beef1\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-01 17:54:48','2019-07-01 18:51:01',NULL),(1662,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Henry&amp;apos;s form\"},\"data\":[{\"label\":\"Text input\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"text_input\",\"formtype\":\"i02\",\"type\":\"text\",\"required\":\"true\",\"name\":\"text_input\",\"value\":\"test\"},{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Zip\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-01 22:43:59','2019-07-02 03:39:56',NULL),(1672,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-174\"},\"data\":[]}','2019-07-02 00:33:15','2019-07-02 00:33:15',NULL),(1682,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"DFB-174\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\",\"maxlength\":\"10\"},{\"label\":\"Date\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Numbers\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"numbers\",\"formtype\":\"d06\",\"type\":\"number\",\"required\":\"true\",\"minlength\":\"1\",\"maxlength\":\"3\",\"max\":\"100\"},{\"label\":\"URL\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"url\",\"formtype\":\"d10\",\"type\":\"url\",\"required\":\"true\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"name\":\"file_upload\",\"type\":\"file\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-02 00:33:17','2019-07-02 00:44:53',NULL),(1692,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"dummyform365\"},\"data\":[]}','2019-07-02 16:22:54','2019-07-02 16:22:54',NULL),(1702,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"dummyform365\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\"},{\"label\":\"File Button\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"name\":\"file_upload\",\"type\":\"file\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-02 16:22:56','2019-07-02 16:23:09',NULL),(1872,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"dummydum2\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-02 21:28:00','2019-07-02 21:28:23',NULL),(1912,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"MyFormdumdumdum\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-02 21:35:03','2019-07-02 21:35:03',NULL),(1922,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"myf320\"},\"data\":[]}','2019-07-02 21:35:36','2019-07-02 21:35:36',NULL),(1932,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"myf320\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"placeholder\",\"help\":\"Supporting help text\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-02 21:35:39','2019-07-02 21:35:40',NULL),(2332,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"pho\"},\"data\":[]}','2019-07-08 23:29:56','2019-07-08 23:29:56',NULL),(2342,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"naengmyun\"},\"data\":[]}','2019-07-08 23:36:03','2019-07-08 23:36:03',NULL),(2442,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"167\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Price\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"price\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-09 16:53:53','2019-07-09 16:54:04',NULL),(2472,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"350\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Price\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"price\",\"formtype\":\"d08\",\"type\":\"number\",\"required\":\"true\"},{\"textarea\":\"This is a block of text in a paragraph\",\"id\":\"paragraph_text\",\"formtype\":\"m08\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-09 23:55:34','2019-07-09 23:56:43',NULL),(2532,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"167\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Text input\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"BAN\",\"formtype\":\"i02\",\"type\":\"number\",\"required\":\"true\",\"name\":\"BAN\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"id\":\"address\",\"formtype\":\"s08\",\"name\":\"address\",\"required\":\"true\",\"webhooks\":{\"ids\":[\"BAN\"],\"endpoint\":\"http:\\/\\/apps.sfgov.org\\/bpdev\\/sites\\/all\\/modules\\/ccsf_api\\/TTX\\/BAN.php?type=OOC\",\"responseIndex\":\"StreetAddress\",\"method\":\"json\",\"optionsArray\":\"true\",\"delimiter\":\"\",\"responseOptionsIndex\":\"\"}},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-12 23:22:21','2019-07-12 23:50:03',NULL),(2632,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"378\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/www.google.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Date\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"date\",\"formtype\":\"d02\",\"type\":\"date\",\"required\":\"true\"},{\"label\":\"Price\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"price\",\"formtype\":\"d08\",\"name\":\"price\",\"type\":\"number\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-15 23:34:02','2019-07-22 21:51:46',NULL),(2772,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"test407\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-23 17:07:00','2019-07-23 17:11:28',NULL),(2782,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"test405b\"},\"data\":[]}','2019-07-23 17:11:51','2019-07-23 17:11:51',NULL),(2792,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"test405c\"},\"data\":[]}','2019-07-23 17:12:17','2019-07-23 17:12:17',NULL),(2812,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"dumdumdum215\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/wired.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"What is your favorite summer activity?\",\"radios\":[\"aquarium\",\"bake off\"],\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"type\":\"text\",\"required\":\"true\",\"help\":\"\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-23 17:17:12','2019-07-23 18:27:04',NULL),(2832,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"389\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/google.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Vegan favorite foods\",\"radios\":[\"Tofu\",\"Tofurkey\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-24 22:01:25','2019-07-24 22:05:01',NULL),(2842,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"dym\",\"backend\":\"csv\"},\"data\":[{\"label\":\"BAN\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"BAN\",\"formtype\":\"i02\",\"name\":\"BAN\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address\",\"radios\":[\"One\",\"Two\"],\"help\":\"\",\"id\":\"address\",\"formtype\":\"s08\",\"name\":\"address\",\"required\":\"true\",\"type\":\"text\",\"webhooks\":{\"ids\":[\"BAN\"],\"endpoint\":\"http:\\/\\/apps.sfgov.org\\/bpdev\\/sites\\/all\\/modules\\/ccsf_api\\/TTX\\/BAN.php?type=OOC\",\"responseIndex\":\"address\",\"method\":\"json\",\"optionsArray\":\"true\",\"delimiter\":\"\",\"responseOptionsIndex\":\"\"}},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-25 19:28:57','2019-07-25 19:35:07',NULL),(2852,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"293\",\"backend\":\"db\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"What number(s) do you identify with?\",\"checkboxes\":[\"Odds\",\"Evens\",\"Primes\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Who is your favorite?\",\"radios\":[\"A\",\"B\",\"C\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Choose your favorite donut\",\"option\":[\"Maple Bar\",\"Jelly Filled\",\"Old Fashioned\",\"French Crueller\"],\"help\":\"\",\"id\":\"select_dropdown\",\"formtype\":\"s02\",\"name\":\"select_dropdown\",\"required\":\"true\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-25 23:32:25','2019-07-25 23:38:49',NULL),(2862,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"374\"},\"data\":[{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-25 23:45:27','2019-07-25 23:51:29',NULL),(2872,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"173\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-26 22:22:48','2019-07-26 22:22:48',NULL),(2892,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"173\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"id\":\"multiple_checkboxes_1\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes_1\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-07-26 22:22:55','2019-07-26 22:47:19',NULL),(2912,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"173\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes_1\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes_1\",\"required\":\"true\"},{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\"}]}','2019-07-26 22:25:15','2019-07-26 22:25:15',NULL),(2922,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"173\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\"}]}','2019-07-26 22:46:35','2019-07-26 22:46:35',NULL),(2932,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"173\"},\"data\":[]}','2019-07-26 22:47:07','2019-07-26 22:47:07',NULL),(3002,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"226\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/google.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"codearea\":\"This is an &lt;a href=https:\\/\\/google.com target =_blank&gt;anchor&lt;\\/a&gt;\",\"id\":\"paragraph_html\",\"formtype\":\"m10\",\"name\":\"paragraph_html\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-01 16:32:28','2019-08-01 16:35:58',NULL),(3042,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"327\",\"backend\":\"db\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-02 21:22:16','2019-08-02 21:22:43',NULL),(3082,'{\"settings\":{\"action\":\"http:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"244\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/google.com\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Radio buttons 2\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"name\":\"multiple_radios_1\",\"required\":\"true\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-05 23:36:43','2019-08-06 16:25:00',NULL),(3092,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"259\"},\"data\":[{\"label\":\"Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-06 00:12:23','2019-08-06 00:12:23',NULL),(3132,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"419\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/google.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-06 19:35:37','2019-08-06 19:35:56',NULL),(3142,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"419\",\"backend\":\"csv\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_1\",\"formtype\":\"c02\",\"name\":\"name_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-06 19:37:03','2019-08-06 19:37:19',NULL),(3152,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"293\",\"backend\":\"csv\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-06 19:37:46','2019-08-06 19:37:55',NULL),(3172,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"413\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/google.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-07 17:13:18','2019-08-07 17:42:04',NULL),(3182,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"259\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/finance.yahoo.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-07 22:24:49','2019-08-07 22:25:22',NULL),(3377,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"GET\",\"name\":\"345\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/finance.yahoo.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"name\":\"page_separator\",\"type\":\"text\"},{\"label\":\"Numbers\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers\",\"formtype\":\"d06\",\"name\":\"numbers\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Textarea\",\"textarea\":\" \",\"help\":\"\",\"id\":\"textarea\",\"formtype\":\"i14\",\"name\":\"textarea\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"name\":\"page_separator_1\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-15 21:35:54','2019-08-15 21:36:45',NULL),(3378,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"Test form\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/finance.yahoo.com\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"name\":\"page_separator\",\"type\":\"text\"},{\"textarea\":\"Contact info\\n\",\"id\":\"name_1\",\"formtype\":\"m06\",\"name\":\"name_1\",\"type\":\"text\"},{\"label\":\"Address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address\",\"formtype\":\"c08\",\"name\":\"address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"City\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"city\",\"formtype\":\"c10\",\"name\":\"city\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Zip\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"name\":\"page_separator_1\",\"type\":\"text\"},{\"textarea\":\"H3 Header Text\",\"id\":\"name_2\",\"formtype\":\"m06\",\"name\":\"name_2\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_3\",\"formtype\":\"c02\",\"name\":\"name_3\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-15 21:56:41','2019-08-15 21:58:33',NULL),(3391,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"My new Form\",\"backend\":\"csv\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"one \\\\r two &amp;amp;amp;amp;lt;br \\/&amp;amp;amp;amp;gt; \\\\n three\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Eins\",\"Zwei\",\"Drei\"],\"help\":\"\",\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"name\":\"multiple_radios_1\",\"required\":\"true\",\"value\":\"Zwei\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-20 17:55:07','2019-08-28 19:54:47',NULL),(3404,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"Prod Test\"},\"data\":[{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\",\"value\":\"test\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email_1\",\"formtype\":\"c04\",\"name\":\"email_1\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-23 17:08:06','2019-09-03 23:25:03',NULL),(3409,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"asdf\"},\"data\":[{\"label\":\"asdf\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-26 23:01:43','2019-08-26 23:02:05',NULL),(3411,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"123\"},\"data\":[{\"label\":\"123\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-26 23:13:11','2019-08-26 23:13:21',NULL),(3412,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"234\"},\"data\":[{\"label\":\"234\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-26 23:19:05','2019-08-26 23:19:12',NULL),(3414,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"311Form\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-26 23:38:27','2019-08-26 23:38:34',NULL),(3415,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"aaa\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-26 23:42:06','2019-08-26 23:42:16',NULL),(3416,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"bbb\"},\"data\":[{\"label\":\"bbb\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-26 23:55:35','2019-08-26 23:56:08',NULL),(3417,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"ccc\"},\"data\":[{\"label\":\"ccc\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-26 23:57:33','2019-08-26 23:58:09',NULL),(3418,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"ddd\"},\"data\":[{\"label\":\"ddd\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"ddd\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"ddd\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-27 00:00:34','2019-08-27 00:01:17',NULL),(3423,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"POST\",\"name\":\"Are you ready to apply for an ADU?\",\"backend\":\"csv\"},\"data\":[{\"textarea\":\"This application will ask you about:\\n- The owner&apos;s and agent&apos;s contact information\\n-Construction details like the project address, cost, and excavation area\\n-How you are currently using the land, and how you plan to change it\\n- Safety-related topics like fire protection, seismic retrofitting, and worker&apos;s compensation insurance\\n\\nIf you are not building the ADU yourself, you might need a professional to help you answer some questions. If you have not hired an architect, contractor or engineer, you might want to do so before applying.\",\"id\":\"paragraph_text\",\"formtype\":\"m08\",\"name\":\"paragraph_text\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"name\":\"page_separator\",\"type\":\"text\"},{\"textarea\":\"About the owner\",\"id\":\"about_the_owner_1\",\"formtype\":\"m06\",\"name\":\"name\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Phone\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone\",\"formtype\":\"c06\",\"name\":\"phone\",\"type\":\"tel\",\"required\":\"false\",\"minlength\":\"10\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"name\":\"page_separator_1\",\"type\":\"text\"},{\"textarea\":\"About the owner\",\"id\":\"about_the_owner_2\",\"formtype\":\"m06\",\"name\":\"name_2\",\"type\":\"text\"},{\"label\":\"Mailing address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"mailing_address\",\"formtype\":\"c08\",\"name\":\"mailing_address\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Will this also be the address of your ADU?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"also_address_of_adu\",\"formtype\":\"s08\",\"name\":\"also_address_of_adu\",\"required\":\"true\",\"type\":\"text\"},{\"codearea\":\"&lt;b&gt;Project address&lt;\\/b&gt;\",\"id\":\"project_address\",\"formtype\":\"m10\",\"name\":\"paragraph_html\",\"type\":\"text\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"project_address\",\"op\":\"matches\",\"val\":\"no\"}]}},{\"label\":\"Street\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"project_address_street\",\"formtype\":\"c08\",\"name\":\"project_address_street\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"also_address_of_adu\",\"op\":\"matches\",\"val\":\"no\"}]}},{\"label\":\"Zip\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"project_address_zip\",\"formtype\":\"c14\",\"name\":\"project_address_zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"also_address_of_adu\",\"op\":\"matches\",\"val\":\"no\"}]}},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-27 21:39:04','2019-08-27 22:00:27',NULL),(3442,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"GET\",\"name\":\"ADU form\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/finance.yahoo.com\"},\"data\":[{\"textarea\":\"Are you ready to apply for an ADU?\",\"id\":\"name_3\",\"formtype\":\"m02\",\"name\":\"name_6\",\"type\":\"text\"},{\"textarea\":\"This application will ask you about:\",\"id\":\"ADU_form_header\",\"formtype\":\"m06\",\"name\":\"name\",\"type\":\"text\"},{\"codearea\":\"This application will ask you about:\\n\\nThe owners and agents contact information\\n\\nConstruction details like the project address, cost, and excavation area\\n\\nHow you are currently using the land, and how you plan to change it\\n\\nSafety-related topics like fire protection, seismic retrofitting, and workers compensation insurance\\n\\n\",\"id\":\"adu_intro_subtext\",\"formtype\":\"m10\",\"name\":\"paragraph_html\",\"type\":\"text\"},{\"textarea\":\"If you are not building the ADU yourself, you might need a professional to help you answer some questions. If you have not yet hired a architect, contractor or engineer, you might want to do so before applying.\",\"id\":\"paragraph_text\",\"formtype\":\"m08\",\"name\":\"paragraph_text\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"name\":\"page_separator\",\"type\":\"text\",\"textarea\":\"About the owner\"},{\"textarea\":\"About the owner\",\"id\":\"name\",\"formtype\":\"m06\",\"name\":\"name_1\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_1\",\"formtype\":\"c02\",\"name\":\"name_2\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Phone number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone_number_1\",\"formtype\":\"c06\",\"name\":\"phone_number_1\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Email address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"name\":\"page_separator_1\",\"type\":\"text\"},{\"textarea\":\"About the owner\",\"id\":\"about_the_owner_2\",\"formtype\":\"m06\",\"name\":\"name_3\",\"type\":\"text\"},{\"label\":\"Mailing address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"mailing_address_1\",\"formtype\":\"c08\",\"name\":\"mailing_address_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Will this also be the address of your ADU?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"address_of_adu_select\",\"required\":\"true\",\"type\":\"text\"},{\"textarea\":\"Project address\",\"id\":\"name_2\",\"formtype\":\"m06\",\"name\":\"name_4\",\"type\":\"text\"},{\"label\":\"Address line 1\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address_1\",\"formtype\":\"c08\",\"name\":\"address_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address line 2\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address_2\",\"formtype\":\"c08\",\"name\":\"address_2\",\"type\":\"text\",\"required\":\"false\"},{\"label\":\"Zip code\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"name\":\"page_separator_2\",\"type\":\"text\"},{\"textarea\":\"About the owner\",\"id\":\"about_the_owner_3\",\"formtype\":\"m06\",\"name\":\"name_5\",\"type\":\"text\"},{\"label\":\"Are you, the owner, also building this ADU?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_3\",\"formtype\":\"m16\",\"name\":\"page_separator_3\",\"type\":\"text\"},{\"textarea\":\"Builder&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;s information\",\"id\":\"builders_information\",\"formtype\":\"m06\",\"name\":\"name_7\",\"type\":\"text\"},{\"textarea\":\"Who should we talk to when working on your application?\",\"id\":\"builders_info_desc\",\"formtype\":\"m08\",\"name\":\"paragraph_text_1\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_4\",\"formtype\":\"c02\",\"name\":\"name_8\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Relationship to owner\",\"radios\":[\"Architect\",\"Contractor\",\"Engineer\",\"Attorney\"],\"help\":\"\",\"id\":\"relationship_to_owner\",\"formtype\":\"s08\",\"name\":\"relationship_to_owner\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Name of organization\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_of_org\",\"formtype\":\"c02\",\"name\":\"name_of_org\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Mailing address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"mailing_address_2\",\"formtype\":\"c08\",\"name\":\"mailing_address_2\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Phone number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone_number_2\",\"formtype\":\"c06\",\"name\":\"phone_number_2\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email_1\",\"formtype\":\"c04\",\"name\":\"email_1\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_4\",\"formtype\":\"m16\",\"name\":\"page_separator_4\",\"type\":\"text\"},{\"textarea\":\"Your property\",\"id\":\"name_5\",\"formtype\":\"m06\",\"name\":\"name_9\",\"type\":\"text\"},{\"label\":\"Present use\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input\",\"formtype\":\"i02\",\"name\":\"text_input\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Proposed use\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_1\",\"formtype\":\"i02\",\"name\":\"text_input_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_5\",\"formtype\":\"m16\",\"name\":\"page_separator_5\",\"type\":\"text\"},{\"textarea\":\"Construction work\",\"id\":\"name_6\",\"formtype\":\"m06\",\"name\":\"name_10\",\"type\":\"text\"},{\"label\":\"Describe the work you are proposing in detail.\",\"textarea\":\" \",\"help\":\"\",\"id\":\"textarea\",\"formtype\":\"i14\",\"name\":\"textarea\",\"required\":\"true\",\"placeholder\":\"\"},{\"codearea\":\"You should include 1) The number of ADUs you plan to add 2) The city ordinances they each comply with 3) A detailed description of all other planned work\\n4) Any special authorizations or changes to the Planning Code or Zoning Maps\",\"id\":\"paragraph_html\",\"formtype\":\"m10\",\"name\":\"paragraph_html_1\",\"type\":\"text\"},{\"label\":\"Type of construction\",\"option\":[\"I-A: Fire Resistive Non-Combustible\",\"I-B: Fire Resistive Non-Combustible\",\"II-A: Protected Non-Combustible\",\"II-B: Unprotected Non-Combustible\",\"III-A: Protected Combustible\",\"III-B: Unprotected Combustible\",\"IV: Heavy Timber\",\"V-A: Protected Wood Frame\",\"V-B: Unprotected Wood Frame\"],\"help\":\"\",\"id\":\"type_of_construction\",\"formtype\":\"s02\",\"name\":\"type_of_construction\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Estimated cost\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"est_cost\",\"formtype\":\"d08\",\"name\":\"est_cost\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"How long do you estimate it will take you to build the ADU?\",\"placeholder\":\"\",\"help\":\"Number of months\",\"id\":\"time_to_build\",\"formtype\":\"d06\",\"name\":\"time_to_build\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_6\",\"formtype\":\"m16\",\"name\":\"page_separator_6\",\"type\":\"text\"},{\"textarea\":\"Construction impact\",\"id\":\"construction_impact\",\"formtype\":\"m06\",\"name\":\"name_11\",\"type\":\"text\"},{\"label\":\"Excavation area\",\"placeholder\":\"square feet\",\"help\":\"\",\"id\":\"numbers\",\"formtype\":\"d06\",\"name\":\"numbers\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Excavation volume\",\"placeholder\":\"cubic yards\",\"help\":\"\",\"id\":\"numbers_1\",\"formtype\":\"d06\",\"name\":\"numbers_1\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Upload a geotechnical report\",\"help\":\"Also show this if PIM says the slope is at least 20%\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"name\":\"file_upload\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"Including foundation work, how deep will you disturb the surface below grade?\",\"placeholder\":\"feet\",\"help\":\"\",\"id\":\"numbers_2\",\"formtype\":\"d06\",\"name\":\"numbers_2\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_7\",\"formtype\":\"m16\",\"name\":\"page_separator_7\",\"type\":\"text\"},{\"textarea\":\"Construction impact\",\"id\":\"name_7\",\"formtype\":\"m06\",\"name\":\"name_12\",\"type\":\"text\"},{\"label\":\"Will the work involve any of the following?\",\"checkboxes\":[\"Repairing or replacing the buildings foundation [ADD APOSTROPHE]\",\"Building a driveway or auto runway\",\"Using street space\",\"Changing the front facade\",\"Extending the building beyond the property line\",\"Plumbing work\",\"Electrical work\",\"Adding height to the existing building\",\"Adding a deck or horizontal extension\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"What is the new height at the center line of the front of the building?\",\"placeholder\":\"inches\",\"help\":\"\",\"id\":\"new_height\",\"formtype\":\"d06\",\"name\":\"new_height\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"What will the new ground floor area be?\",\"placeholder\":\"square feet\",\"help\":\"\",\"id\":\"new_ground_floor_area\",\"formtype\":\"d06\",\"name\":\"new_ground_floor_area\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_8\",\"formtype\":\"m16\",\"name\":\"page_separator_8\",\"type\":\"text\"},{\"textarea\":\"Construction impact\",\"id\":\"name_8\",\"formtype\":\"m06\",\"name\":\"name_13\",\"type\":\"text\"},{\"label\":\"Will this ADU remove housing services? [ADD HELP text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_2\",\"formtype\":\"s08\",\"name\":\"multiple_radios_1\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Is this site currently in industrial use? [ADD Help text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_3\",\"formtype\":\"s08\",\"name\":\"multiple_radios_2\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_9\",\"formtype\":\"m16\",\"name\":\"page_separator_9\",\"type\":\"text\"},{\"textarea\":\"Parking area\",\"id\":\"name_9\",\"formtype\":\"m06\",\"name\":\"name_14\",\"type\":\"text\"},{\"label\":\"How many square feet of parking space does the property have?\",\"placeholder\":\"gross feet\",\"help\":\"\",\"id\":\"numbers_3\",\"formtype\":\"d06\",\"name\":\"numbers_3\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_4\",\"formtype\":\"s08\",\"name\":\"multiple_radios_3\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How much parking space will there be?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_4\",\"formtype\":\"d06\",\"name\":\"numbers_4\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_10\",\"formtype\":\"m16\",\"name\":\"page_separator_10\",\"type\":\"text\"},{\"textarea\":\"Parking spaces\",\"id\":\"name_10\",\"formtype\":\"m06\",\"name\":\"name_15\",\"type\":\"text\"},{\"label\":\"How many parking space does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_5\",\"formtype\":\"d06\",\"name\":\"numbers_5\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_5\",\"formtype\":\"s08\",\"name\":\"multiple_radios_4\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many parking spaces will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_6\",\"formtype\":\"d06\",\"name\":\"numbers_6\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_11\",\"formtype\":\"m16\",\"name\":\"page_separator_11\",\"type\":\"text\"},{\"textarea\":\"Residential area\",\"id\":\"name_11\",\"formtype\":\"m06\",\"name\":\"name_16\",\"type\":\"text\"},{\"label\":\"How many square feet of residential space does the property have?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_7\",\"formtype\":\"d06\",\"name\":\"numbers_7\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_6\",\"formtype\":\"s08\",\"name\":\"multiple_radios_5\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How much residential space will there be?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_8\",\"formtype\":\"d06\",\"name\":\"numbers_8\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_12\",\"formtype\":\"m16\",\"name\":\"page_separator_12\",\"type\":\"text\"},{\"textarea\":\"Affordable dwelling units\",\"id\":\"adu_subtitle\",\"formtype\":\"m06\",\"name\":\"name_17\",\"type\":\"text\"},{\"label\":\"How many affordable dwelling units does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_9\",\"formtype\":\"d06\",\"name\":\"numbers_9\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_7\",\"formtype\":\"s08\",\"name\":\"multiple_radios_6\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many affordable dwelling units will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_10\",\"formtype\":\"d06\",\"name\":\"numbers_10\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_13\",\"formtype\":\"m16\",\"name\":\"page_separator_13\",\"type\":\"text\"},{\"textarea\":\"Market-rate dwelling units\",\"id\":\"name_12\",\"formtype\":\"m06\",\"name\":\"name_18\",\"type\":\"text\"},{\"label\":\"How many market-rate dwelling units does the property have?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_11\",\"formtype\":\"d06\",\"name\":\"numbers_11\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_8\",\"formtype\":\"s08\",\"name\":\"multiple_radios_7\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many market-rate dwelling units will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_12\",\"formtype\":\"d06\",\"name\":\"numbers_12\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Zip\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip_1\",\"formtype\":\"c14\",\"name\":\"zip_1\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_14\",\"formtype\":\"m16\",\"name\":\"page_separator_14\",\"type\":\"text\"},{\"textarea\":\"Commercial area\",\"id\":\"name_13\",\"formtype\":\"m06\",\"name\":\"name_19\",\"type\":\"text\"},{\"label\":\"How many square feet of commercial space does the property have?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_13\",\"formtype\":\"d06\",\"name\":\"numbers_13\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios_9\",\"formtype\":\"s08\",\"name\":\"multiple_radios_8\",\"required\":\"true\"},{\"label\":\"How much commercial space will there be?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_14\",\"formtype\":\"d06\",\"name\":\"numbers_14\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_15\",\"formtype\":\"m16\",\"name\":\"page_separator_15\",\"type\":\"text\"},{\"textarea\":\"Buildings\",\"id\":\"name_14\",\"formtype\":\"m06\",\"name\":\"name_20\",\"type\":\"text\"},{\"label\":\"How many buildings does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_15\",\"formtype\":\"d06\",\"name\":\"numbers_15\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_10\",\"formtype\":\"s08\",\"name\":\"multiple_radios_9\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many buildings will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_16\",\"formtype\":\"d06\",\"name\":\"numbers_16\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_16\",\"formtype\":\"m16\",\"name\":\"page_separator_16\",\"type\":\"text\"},{\"textarea\":\"Building stories\",\"id\":\"name_15\",\"formtype\":\"m06\",\"name\":\"name_21\",\"type\":\"text\"},{\"label\":\"How many stories does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_17\",\"formtype\":\"d06\",\"name\":\"numbers_17\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_11\",\"formtype\":\"s08\",\"name\":\"multiple_radios_10\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many stories will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_18\",\"formtype\":\"d06\",\"name\":\"numbers_18\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_17\",\"formtype\":\"m16\",\"name\":\"page_separator_17\",\"type\":\"text\"},{\"textarea\":\"Basements\\/ cellars\",\"id\":\"name_16\",\"formtype\":\"m06\",\"name\":\"name_22\",\"type\":\"text\"},{\"label\":\"How many basements or cellars does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_20\",\"formtype\":\"d06\",\"name\":\"numbers_20\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_12\",\"formtype\":\"s08\",\"name\":\"multiple_radios_11\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many basements or cellars will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_19\",\"formtype\":\"d06\",\"name\":\"numbers_19\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_18\",\"formtype\":\"m16\",\"name\":\"page_separator_18\",\"type\":\"text\"},{\"textarea\":\"Bicycle spaces\",\"id\":\"name_17\",\"formtype\":\"m06\",\"name\":\"name_23\",\"type\":\"text\"},{\"label\":\"How many bicycle spaces does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_22\",\"formtype\":\"d06\",\"name\":\"numbers_22\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_13\",\"formtype\":\"s08\",\"name\":\"multiple_radios_12\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many bicycle spaces will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_21\",\"formtype\":\"d06\",\"name\":\"numbers_21\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_19\",\"formtype\":\"m16\",\"name\":\"page_separator_19\",\"type\":\"text\"},{\"textarea\":\"Fire protection\",\"id\":\"name_18\",\"formtype\":\"m06\",\"name\":\"name_24\",\"type\":\"text\"},{\"label\":\"Does the property have fire sprinklers?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_14\",\"formtype\":\"s08\",\"name\":\"multiple_radios_13\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Which areas of the property do the sprinklers cover?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_23\",\"formtype\":\"d06\",\"name\":\"numbers_23\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Does the property have fire alarms?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_15\",\"formtype\":\"s08\",\"name\":\"multiple_radios_14\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Which areas of the property do the alarms cover?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_24\",\"formtype\":\"d06\",\"name\":\"numbers_24\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_20\",\"formtype\":\"m16\",\"name\":\"page_separator_20\",\"type\":\"text\"},{\"textarea\":\"Workers Compensation [Add apostrophe]\",\"id\":\"name_19\",\"formtype\":\"m06\",\"name\":\"name_25\",\"type\":\"text\"},{\"label\":\"What best describes your worker&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;s compensation insurance coverage for this project?\",\"checkboxes\":[\"I am self-insured and have a certificate of consent.\",\"I have third-party insurance\",\"I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]\",\"I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.\",\"I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.\"],\"help\":\"\",\"id\":\"multiple_checkboxes_1\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes_1\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Name of insurance carrier\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_2\",\"formtype\":\"i02\",\"name\":\"text_input_2\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Policy number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_25\",\"formtype\":\"d06\",\"name\":\"numbers_25\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_21\",\"formtype\":\"m16\",\"name\":\"page_separator_21\",\"type\":\"text\",\"textarea\":\"Test divider\\n\"},{\"textarea\":\"Seismic work\",\"id\":\"name_20\",\"formtype\":\"m06\",\"name\":\"name_26\",\"type\":\"text\"},{\"label\":\"Have you applied for a seismic retrofitting permit?[ADD help text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_16\",\"formtype\":\"s08\",\"name\":\"multiple_radios_15\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"What is your seismic retrofitting permit application number?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_26\",\"formtype\":\"d06\",\"name\":\"numbers_26\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Have you filed for a seismic strengthening permit?[ADD help text]\",\"radios\":[\"Yes\",\"No\"],\"id\":\"multiple_radios_17\",\"formtype\":\"s08\",\"name\":\"multiple_radios_16\",\"type\":\"text\",\"required\":\"true\",\"help\":\"\"},{\"label\":\"What is your seismic strengthening permit application number?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_27\",\"formtype\":\"d06\",\"name\":\"numbers_27\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Does the building following the ordinances for ADUs? [ADD help text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_18\",\"formtype\":\"s08\",\"name\":\"multiple_radios_17\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_22\",\"formtype\":\"m16\",\"name\":\"page_separator_22\",\"type\":\"text\"},{\"textarea\":\"Environmental assessment\",\"id\":\"name_21\",\"formtype\":\"m06\",\"name\":\"name_27\",\"type\":\"text\"},{\"codearea\":\"If you site has: \\n\\nYou need to upload an environmental site assessment.\",\"id\":\"paragraph_html_1\",\"formtype\":\"m10\",\"name\":\"paragraph_html_2\",\"type\":\"text\"},{\"label\":\"Does the site have any of the above?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_19\",\"formtype\":\"s08\",\"name\":\"multiple_radios_18\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Upload a Phase I Environmental Site Assessment\",\"help\":\"\",\"id\":\"file_upload_1\",\"formtype\":\"m13\",\"name\":\"file_upload_1\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_23\",\"formtype\":\"m16\",\"name\":\"page_separator_23\",\"type\":\"text\"},{\"codearea\":\"This is not a building permit. Until we issue a permit to you, you cannot start work, change the property\\u2019s occupancy, or change its use. (See the San Francisco Building Code and San Francisco Housing Code.)&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\nOnce we issue a building permit, you must post it at the job. The owner will also be responsible for keeping the approved plans and permit application at the property. &amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\nNo one can occupy your ADU until you either:&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\n&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;Have a certificate of final completion posted on the building&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\n&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;Get a permit of occupancy from us&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\nYou will need to follow any stipulations that come up in your application and inspections. You must also follow building code.\",\"id\":\"paragraph_html_2\",\"formtype\":\"m10\",\"name\":\"paragraph_html_3\"},{\"textarea\":\"Terms\",\"id\":\"name_22\",\"formtype\":\"m06\",\"name\":\"name_28\",\"type\":\"text\"},{\"codearea\":\"&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;b&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;Your application&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/b&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\",\"id\":\"paragraph_html_3\",\"formtype\":\"m10\",\"name\":\"paragraph_html_4\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-29 18:21:47','2019-09-04 17:55:45',NULL),(3443,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"load this\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-29 22:35:18','2019-08-29 22:35:25',NULL),(3444,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"form bug 505\"},\"data\":[{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name\",\"formtype\":\"c02\",\"name\":\"name\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"name\",\"op\":\"contains\",\"val\":\"a\"}]}},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-29 22:42:59','2019-08-29 22:43:23',NULL),(3445,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"test checks\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-29 22:42:34','2019-08-29 22:43:04',NULL),(3447,'{\"settings\":{\"action\":\"\",\"method\":\"POST\",\"name\":\"form bug 505\"},\"data\":[{\"label\":\"Checkboxes\",\"checkboxes\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\"},{\"label\":\"Text input\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input\",\"formtype\":\"i02\",\"name\":\"text_input\",\"type\":\"text\",\"required\":\"true\",\"conditions\":{\"showHide\":\"Show\",\"allAny\":false,\"condition\":[{\"id\":\"multiple_checkboxes\",\"op\":\"contains\",\"val\":\"a\"}]}},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-08-29 22:44:50','2019-08-29 23:07:37',NULL),(3479,'{\"settings\":{\"action\":\"https:\\/\\/formbuilder-sf-staging.herokuapp.com\\/form\\/submit\",\"method\":\"GET\",\"name\":\"Clone of ADU form\",\"backend\":\"csv\",\"confirmation\":\"https:\\/\\/finance.yahoo.com\"},\"data\":[{\"textarea\":\"Are you ready to apply for an ADU?\",\"id\":\"name_3\",\"formtype\":\"m02\",\"name\":\"name_6\",\"type\":\"text\"},{\"textarea\":\"This application will ask you about:\",\"id\":\"ADU_form_header\",\"formtype\":\"m06\",\"name\":\"name\",\"type\":\"text\"},{\"codearea\":\"This application will ask you about:\\n\\nThe owners and agents contact information\\n\\nConstruction details like the project address, cost, and excavation area\\n\\nHow you are currently using the land, and how you plan to change it\\n\\nSafety-related topics like fire protection, seismic retrofitting, and workers compensation insurance\\n\\n\",\"id\":\"adu_intro_subtext\",\"formtype\":\"m10\",\"name\":\"paragraph_html\",\"type\":\"text\"},{\"textarea\":\"If you are not building the ADU yourself, you might need a professional to help you answer some questions. If you have not yet hired a architect, contractor or engineer, you might want to do so before applying.\",\"id\":\"paragraph_text\",\"formtype\":\"m08\",\"name\":\"paragraph_text\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator\",\"formtype\":\"m16\",\"name\":\"page_separator\",\"type\":\"text\",\"textarea\":\"About the owner\"},{\"textarea\":\"About the owner\",\"id\":\"name\",\"formtype\":\"m06\",\"name\":\"name_1\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_1\",\"formtype\":\"c02\",\"name\":\"name_2\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Phone number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone_number_1\",\"formtype\":\"c06\",\"name\":\"phone_number_1\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Email address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email\",\"formtype\":\"c04\",\"name\":\"email\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_1\",\"formtype\":\"m16\",\"name\":\"page_separator_1\",\"type\":\"text\"},{\"textarea\":\"About the owner\",\"id\":\"about_the_owner_2\",\"formtype\":\"m06\",\"name\":\"name_3\",\"type\":\"text\"},{\"label\":\"Mailing address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"mailing_address_1\",\"formtype\":\"c08\",\"name\":\"mailing_address_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Will this also be the address of your ADU?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios\",\"formtype\":\"s08\",\"name\":\"address_of_adu_select\",\"required\":\"true\",\"type\":\"text\"},{\"textarea\":\"Project address\",\"id\":\"name_2\",\"formtype\":\"m06\",\"name\":\"name_4\",\"type\":\"text\"},{\"label\":\"Address line 1\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address_1\",\"formtype\":\"c08\",\"name\":\"address_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Address line 2\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"address_2\",\"formtype\":\"c08\",\"name\":\"address_2\",\"type\":\"text\",\"required\":\"false\"},{\"label\":\"Zip code\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip\",\"formtype\":\"c14\",\"name\":\"zip\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_2\",\"formtype\":\"m16\",\"name\":\"page_separator_2\",\"type\":\"text\"},{\"textarea\":\"About the owner\",\"id\":\"about_the_owner_3\",\"formtype\":\"m06\",\"name\":\"name_5\",\"type\":\"text\"},{\"label\":\"Are you, the owner, also building this ADU?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_1\",\"formtype\":\"s08\",\"name\":\"multiple_radios\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_3\",\"formtype\":\"m16\",\"name\":\"page_separator_3\",\"type\":\"text\"},{\"textarea\":\"Builder&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;s information\",\"id\":\"builders_information\",\"formtype\":\"m06\",\"name\":\"name_7\",\"type\":\"text\"},{\"textarea\":\"Who should we talk to when working on your application?\",\"id\":\"builders_info_desc\",\"formtype\":\"m08\",\"name\":\"paragraph_text_1\",\"type\":\"text\"},{\"label\":\"Name\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_4\",\"formtype\":\"c02\",\"name\":\"name_8\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Relationship to owner\",\"radios\":[\"Architect\",\"Contractor\",\"Engineer\",\"Attorney\"],\"help\":\"\",\"id\":\"relationship_to_owner\",\"formtype\":\"s08\",\"name\":\"relationship_to_owner\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Name of organization\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"name_of_org\",\"formtype\":\"c02\",\"name\":\"name_of_org\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Mailing address\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"mailing_address_2\",\"formtype\":\"c08\",\"name\":\"mailing_address_2\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Phone number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"phone_number_2\",\"formtype\":\"c06\",\"name\":\"phone_number_2\",\"type\":\"tel\",\"required\":\"true\",\"minlength\":\"10\"},{\"label\":\"Email\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"email_1\",\"formtype\":\"c04\",\"name\":\"email_1\",\"type\":\"email\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_4\",\"formtype\":\"m16\",\"name\":\"page_separator_4\",\"type\":\"text\"},{\"textarea\":\"Your property\",\"id\":\"name_5\",\"formtype\":\"m06\",\"name\":\"name_9\",\"type\":\"text\"},{\"label\":\"Present use\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input\",\"formtype\":\"i02\",\"name\":\"text_input\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Proposed use\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_1\",\"formtype\":\"i02\",\"name\":\"text_input_1\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_5\",\"formtype\":\"m16\",\"name\":\"page_separator_5\",\"type\":\"text\"},{\"textarea\":\"Construction work\",\"id\":\"name_6\",\"formtype\":\"m06\",\"name\":\"name_10\",\"type\":\"text\"},{\"label\":\"Describe the work you are proposing in detail.\",\"textarea\":\" \",\"help\":\"\",\"id\":\"textarea\",\"formtype\":\"i14\",\"name\":\"textarea\",\"required\":\"true\",\"placeholder\":\"\"},{\"codearea\":\"You should include 1) The number of ADUs you plan to add 2) The city ordinances they each comply with 3) A detailed description of all other planned work\\n4) Any special authorizations or changes to the Planning Code or Zoning Maps\",\"id\":\"paragraph_html\",\"formtype\":\"m10\",\"name\":\"paragraph_html_1\",\"type\":\"text\"},{\"label\":\"Type of construction\",\"option\":[\"I-A: Fire Resistive Non-Combustible\",\"I-B: Fire Resistive Non-Combustible\",\"II-A: Protected Non-Combustible\",\"II-B: Unprotected Non-Combustible\",\"III-A: Protected Combustible\",\"III-B: Unprotected Combustible\",\"IV: Heavy Timber\",\"V-A: Protected Wood Frame\",\"V-B: Unprotected Wood Frame\"],\"help\":\"\",\"id\":\"type_of_construction\",\"formtype\":\"s02\",\"name\":\"type_of_construction\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Estimated cost\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"est_cost\",\"formtype\":\"d08\",\"name\":\"est_cost\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"How long do you estimate it will take you to build the ADU?\",\"placeholder\":\"\",\"help\":\"Number of months\",\"id\":\"time_to_build\",\"formtype\":\"d06\",\"name\":\"time_to_build\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_6\",\"formtype\":\"m16\",\"name\":\"page_separator_6\",\"type\":\"text\"},{\"textarea\":\"Construction impact\",\"id\":\"construction_impact\",\"formtype\":\"m06\",\"name\":\"name_11\",\"type\":\"text\"},{\"label\":\"Excavation area\",\"placeholder\":\"square feet\",\"help\":\"\",\"id\":\"numbers\",\"formtype\":\"d06\",\"name\":\"numbers\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Excavation volume\",\"placeholder\":\"cubic yards\",\"help\":\"\",\"id\":\"numbers_1\",\"formtype\":\"d06\",\"name\":\"numbers_1\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Upload a geotechnical report\",\"help\":\"Also show this if PIM says the slope is at least 20%\",\"id\":\"file_upload\",\"formtype\":\"m13\",\"name\":\"file_upload\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"Including foundation work, how deep will you disturb the surface below grade?\",\"placeholder\":\"feet\",\"help\":\"\",\"id\":\"numbers_2\",\"formtype\":\"d06\",\"name\":\"numbers_2\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_7\",\"formtype\":\"m16\",\"name\":\"page_separator_7\",\"type\":\"text\"},{\"textarea\":\"Construction impact\",\"id\":\"name_7\",\"formtype\":\"m06\",\"name\":\"name_12\",\"type\":\"text\"},{\"label\":\"Will the work involve any of the following?\",\"checkboxes\":[\"Repairing or replacing the buildings foundation [ADD APOSTROPHE]\",\"Building a driveway or auto runway\",\"Using street space\",\"Changing the front facade\",\"Extending the building beyond the property line\",\"Plumbing work\",\"Electrical work\",\"Adding height to the existing building\",\"Adding a deck or horizontal extension\"],\"help\":\"\",\"id\":\"multiple_checkboxes\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"What is the new height at the center line of the front of the building?\",\"placeholder\":\"inches\",\"help\":\"\",\"id\":\"new_height\",\"formtype\":\"d06\",\"name\":\"new_height\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"What will the new ground floor area be?\",\"placeholder\":\"square feet\",\"help\":\"\",\"id\":\"new_ground_floor_area\",\"formtype\":\"d06\",\"name\":\"new_ground_floor_area\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_8\",\"formtype\":\"m16\",\"name\":\"page_separator_8\",\"type\":\"text\"},{\"textarea\":\"Construction impact\",\"id\":\"name_8\",\"formtype\":\"m06\",\"name\":\"name_13\",\"type\":\"text\"},{\"label\":\"Will this ADU remove housing services? [ADD HELP text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_2\",\"formtype\":\"s08\",\"name\":\"multiple_radios_1\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Is this site currently in industrial use? [ADD Help text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_3\",\"formtype\":\"s08\",\"name\":\"multiple_radios_2\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_9\",\"formtype\":\"m16\",\"name\":\"page_separator_9\",\"type\":\"text\"},{\"textarea\":\"Parking area\",\"id\":\"name_9\",\"formtype\":\"m06\",\"name\":\"name_14\",\"type\":\"text\"},{\"label\":\"How many square feet of parking space does the property have?\",\"placeholder\":\"gross feet\",\"help\":\"\",\"id\":\"numbers_3\",\"formtype\":\"d06\",\"name\":\"numbers_3\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_4\",\"formtype\":\"s08\",\"name\":\"multiple_radios_3\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How much parking space will there be?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_4\",\"formtype\":\"d06\",\"name\":\"numbers_4\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_10\",\"formtype\":\"m16\",\"name\":\"page_separator_10\",\"type\":\"text\"},{\"textarea\":\"Parking spaces\",\"id\":\"name_10\",\"formtype\":\"m06\",\"name\":\"name_15\",\"type\":\"text\"},{\"label\":\"How many parking space does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_5\",\"formtype\":\"d06\",\"name\":\"numbers_5\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_5\",\"formtype\":\"s08\",\"name\":\"multiple_radios_4\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many parking spaces will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_6\",\"formtype\":\"d06\",\"name\":\"numbers_6\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_11\",\"formtype\":\"m16\",\"name\":\"page_separator_11\",\"type\":\"text\"},{\"textarea\":\"Residential area\",\"id\":\"name_11\",\"formtype\":\"m06\",\"name\":\"name_16\",\"type\":\"text\"},{\"label\":\"How many square feet of residential space does the property have?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_7\",\"formtype\":\"d06\",\"name\":\"numbers_7\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_6\",\"formtype\":\"s08\",\"name\":\"multiple_radios_5\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How much residential space will there be?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_8\",\"formtype\":\"d06\",\"name\":\"numbers_8\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_12\",\"formtype\":\"m16\",\"name\":\"page_separator_12\",\"type\":\"text\"},{\"textarea\":\"Affordable dwelling units\",\"id\":\"adu_subtitle\",\"formtype\":\"m06\",\"name\":\"name_17\",\"type\":\"text\"},{\"label\":\"How many affordable dwelling units does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_9\",\"formtype\":\"d06\",\"name\":\"numbers_9\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_7\",\"formtype\":\"s08\",\"name\":\"multiple_radios_6\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many affordable dwelling units will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_10\",\"formtype\":\"d06\",\"name\":\"numbers_10\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_13\",\"formtype\":\"m16\",\"name\":\"page_separator_13\",\"type\":\"text\"},{\"textarea\":\"Market-rate dwelling units\",\"id\":\"name_12\",\"formtype\":\"m06\",\"name\":\"name_18\",\"type\":\"text\"},{\"label\":\"How many market-rate dwelling units does the property have?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_11\",\"formtype\":\"d06\",\"name\":\"numbers_11\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_8\",\"formtype\":\"s08\",\"name\":\"multiple_radios_7\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many market-rate dwelling units will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_12\",\"formtype\":\"d06\",\"name\":\"numbers_12\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Zip\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"zip_1\",\"formtype\":\"c14\",\"name\":\"zip_1\",\"type\":\"text\",\"required\":\"true\",\"minlength\":\"5\",\"maxlength\":\"5\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_14\",\"formtype\":\"m16\",\"name\":\"page_separator_14\",\"type\":\"text\"},{\"textarea\":\"Commercial area\",\"id\":\"name_13\",\"formtype\":\"m06\",\"name\":\"name_19\",\"type\":\"text\"},{\"label\":\"How many square feet of commercial space does the property have?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_13\",\"formtype\":\"d06\",\"name\":\"numbers_13\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Radio buttons\",\"radios\":[\"Option one\",\"Option two\"],\"help\":\"\",\"id\":\"multiple_radios_9\",\"formtype\":\"s08\",\"name\":\"multiple_radios_8\",\"required\":\"true\"},{\"label\":\"How much commercial space will there be?\",\"placeholder\":\"gross square feet\",\"help\":\"\",\"id\":\"numbers_14\",\"formtype\":\"d06\",\"name\":\"numbers_14\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_15\",\"formtype\":\"m16\",\"name\":\"page_separator_15\",\"type\":\"text\"},{\"textarea\":\"Buildings\",\"id\":\"name_14\",\"formtype\":\"m06\",\"name\":\"name_20\",\"type\":\"text\"},{\"label\":\"How many buildings does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_15\",\"formtype\":\"d06\",\"name\":\"numbers_15\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_10\",\"formtype\":\"s08\",\"name\":\"multiple_radios_9\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many buildings will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_16\",\"formtype\":\"d06\",\"name\":\"numbers_16\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_16\",\"formtype\":\"m16\",\"name\":\"page_separator_16\",\"type\":\"text\"},{\"textarea\":\"Building stories\",\"id\":\"name_15\",\"formtype\":\"m06\",\"name\":\"name_21\",\"type\":\"text\"},{\"label\":\"How many stories does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_17\",\"formtype\":\"d06\",\"name\":\"numbers_17\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_11\",\"formtype\":\"s08\",\"name\":\"multiple_radios_10\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many stories will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_18\",\"formtype\":\"d06\",\"name\":\"numbers_18\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_17\",\"formtype\":\"m16\",\"name\":\"page_separator_17\",\"type\":\"text\"},{\"textarea\":\"Basements\\/ cellars\",\"id\":\"name_16\",\"formtype\":\"m06\",\"name\":\"name_22\",\"type\":\"text\"},{\"label\":\"How many basements or cellars does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_20\",\"formtype\":\"d06\",\"name\":\"numbers_20\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_12\",\"formtype\":\"s08\",\"name\":\"multiple_radios_11\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many basements or cellars will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_19\",\"formtype\":\"d06\",\"name\":\"numbers_19\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_18\",\"formtype\":\"m16\",\"name\":\"page_separator_18\",\"type\":\"text\"},{\"textarea\":\"Bicycle spaces\",\"id\":\"name_17\",\"formtype\":\"m06\",\"name\":\"name_23\",\"type\":\"text\"},{\"label\":\"How many bicycle spaces does the property have?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_22\",\"formtype\":\"d06\",\"name\":\"numbers_22\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Will this change after you build the ADU(s)?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_13\",\"formtype\":\"s08\",\"name\":\"multiple_radios_12\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"How many bicycle spaces will there be?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_21\",\"formtype\":\"d06\",\"name\":\"numbers_21\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_19\",\"formtype\":\"m16\",\"name\":\"page_separator_19\",\"type\":\"text\"},{\"textarea\":\"Fire protection\",\"id\":\"name_18\",\"formtype\":\"m06\",\"name\":\"name_24\",\"type\":\"text\"},{\"label\":\"Does the property have fire sprinklers?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_14\",\"formtype\":\"s08\",\"name\":\"multiple_radios_13\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Which areas of the property do the sprinklers cover?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_23\",\"formtype\":\"d06\",\"name\":\"numbers_23\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Does the property have fire alarms?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_15\",\"formtype\":\"s08\",\"name\":\"multiple_radios_14\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Which areas of the property do the alarms cover?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_24\",\"formtype\":\"d06\",\"name\":\"numbers_24\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_20\",\"formtype\":\"m16\",\"name\":\"page_separator_20\",\"type\":\"text\"},{\"textarea\":\"Workers Compensation [Add apostrophe]\",\"id\":\"name_19\",\"formtype\":\"m06\",\"name\":\"name_25\",\"type\":\"text\"},{\"label\":\"What best describes your worker&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;s compensation insurance coverage for this project?\",\"checkboxes\":[\"I am self-insured and have a certificate of consent.\",\"I have third-party insurance\",\"I plan to hire a contractor who will follow workers compensation laws. [ADD APOSTROPHE]\",\"I dont [APOSTROPHE] need insurance because I&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;m not hiring anyone.\",\"I don&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;apos;t need insurance because the work will cost under $100.\"],\"help\":\"\",\"id\":\"multiple_checkboxes_1\",\"formtype\":\"s06\",\"name\":\"multiple_checkboxes_1\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Name of insurance carrier\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"text_input_2\",\"formtype\":\"i02\",\"name\":\"text_input_2\",\"type\":\"text\",\"required\":\"true\"},{\"label\":\"Policy number\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_25\",\"formtype\":\"d06\",\"name\":\"numbers_25\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_21\",\"formtype\":\"m16\",\"name\":\"page_separator_21\",\"type\":\"text\",\"textarea\":\"Test divider\\n\"},{\"textarea\":\"Seismic work\",\"id\":\"name_20\",\"formtype\":\"m06\",\"name\":\"name_26\",\"type\":\"text\"},{\"label\":\"Have you applied for a seismic retrofitting permit?[ADD help text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_16\",\"formtype\":\"s08\",\"name\":\"multiple_radios_15\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"What is your seismic retrofitting permit application number?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_26\",\"formtype\":\"d06\",\"name\":\"numbers_26\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Have you filed for a seismic strengthening permit?[ADD help text]\",\"radios\":[\"Yes\",\"No\"],\"id\":\"multiple_radios_17\",\"formtype\":\"s08\",\"name\":\"multiple_radios_16\",\"type\":\"text\",\"required\":\"true\",\"help\":\"\"},{\"label\":\"What is your seismic strengthening permit application number?\",\"placeholder\":\"\",\"help\":\"\",\"id\":\"numbers_27\",\"formtype\":\"d06\",\"name\":\"numbers_27\",\"type\":\"number\",\"required\":\"true\"},{\"label\":\"Does the building following the ordinances for ADUs? [ADD help text]\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_18\",\"formtype\":\"s08\",\"name\":\"multiple_radios_17\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_22\",\"formtype\":\"m16\",\"name\":\"page_separator_22\",\"type\":\"text\"},{\"textarea\":\"Environmental assessment\",\"id\":\"name_21\",\"formtype\":\"m06\",\"name\":\"name_27\",\"type\":\"text\"},{\"codearea\":\"If you site has: \\n\\nYou need to upload an environmental site assessment.\",\"id\":\"paragraph_html_1\",\"formtype\":\"m10\",\"name\":\"paragraph_html_2\",\"type\":\"text\"},{\"label\":\"Does the site have any of the above?\",\"radios\":[\"Yes\",\"No\"],\"help\":\"\",\"id\":\"multiple_radios_19\",\"formtype\":\"s08\",\"name\":\"multiple_radios_18\",\"required\":\"true\",\"type\":\"text\"},{\"label\":\"Upload a Phase I Environmental Site Assessment\",\"help\":\"\",\"id\":\"file_upload_1\",\"formtype\":\"m13\",\"name\":\"file_upload_1\",\"type\":\"file\",\"required\":\"true\"},{\"label\":\"Page Separator\",\"id\":\"page_separator_23\",\"formtype\":\"m16\",\"name\":\"page_separator_23\",\"type\":\"text\"},{\"codearea\":\"This is not a building permit. Until we issue a permit to you, you cannot start work, change the property\\u2019s occupancy, or change its use. (See the San Francisco Building Code and San Francisco Housing Code.)&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\nOnce we issue a building permit, you must post it at the job. The owner will also be responsible for keeping the approved plans and permit application at the property. &amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\nNo one can occupy your ADU until you either:&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\n&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;Have a certificate of final completion posted on the building&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\n&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;Get a permit of occupancy from us&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/li&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/br&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\\nYou will need to follow any stipulations that come up in your application and inspections. You must also follow building code.\",\"id\":\"paragraph_html_2\",\"formtype\":\"m10\",\"name\":\"paragraph_html_3\"},{\"textarea\":\"Terms\",\"id\":\"name_22\",\"formtype\":\"m06\",\"name\":\"name_28\",\"type\":\"text\"},{\"codearea\":\"&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;b&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;Your application&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;\\/b&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;\",\"id\":\"paragraph_html_3\",\"formtype\":\"m10\",\"name\":\"paragraph_html_4\",\"type\":\"text\"},{\"button\":\"Submit\",\"id\":\"submit\",\"formtype\":\"m14\",\"color\":\"btn-primary\"}]}','2019-09-04 17:56:08','2019-09-04 17:56:23','2019-09-04 17:56:23');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1322_archive`
--

DROP TABLE IF EXISTS `forms_1322_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1322_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1322_archive`
--

LOCK TABLES `forms_1322_archive` WRITE;
/*!40000 ALTER TABLE `forms_1322_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1322_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1512`
--

DROP TABLE IF EXISTS `forms_1512`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1512` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1512`
--

LOCK TABLES `forms_1512` WRITE;
/*!40000 ALTER TABLE `forms_1512` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1512` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1522`
--

DROP TABLE IF EXISTS `forms_1522`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1522` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` int(11) NOT NULL DEFAULT '52',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1522`
--

LOCK TABLES `forms_1522` WRITE;
/*!40000 ALTER TABLE `forms_1522` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1522` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1562`
--

DROP TABLE IF EXISTS `forms_1562`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1562` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` int(11) NOT NULL DEFAULT '122',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1562`
--

LOCK TABLES `forms_1562` WRITE;
/*!40000 ALTER TABLE `forms_1562` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1562` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1662`
--

DROP TABLE IF EXISTS `forms_1662`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1662` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` int(11) NOT NULL DEFAULT '322',
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'test',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1662`
--

LOCK TABLES `forms_1662` WRITE;
/*!40000 ALTER TABLE `forms_1662` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1662` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1682`
--

DROP TABLE IF EXISTS `forms_1682`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1682` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1682`
--

LOCK TABLES `forms_1682` WRITE;
/*!40000 ALTER TABLE `forms_1682` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1682` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1692`
--

DROP TABLE IF EXISTS `forms_1692`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1692` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1692`
--

LOCK TABLES `forms_1692` WRITE;
/*!40000 ALTER TABLE `forms_1692` DISABLE KEYS */;
INSERT INTO `forms_1692` VALUES (1,'johndoe@example.com',NULL,NULL,'admin'),(2,'henry.jiang@sfgov.org',NULL,NULL,'henry');
/*!40000 ALTER TABLE `forms_1692` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1692_archive`
--

DROP TABLE IF EXISTS `forms_1692_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1692_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1692_archive`
--

LOCK TABLES `forms_1692_archive` WRITE;
/*!40000 ALTER TABLE `forms_1692_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1692_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1702`
--

DROP TABLE IF EXISTS `forms_1702`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1702` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` int(11) NOT NULL DEFAULT '342',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1702`
--

LOCK TABLES `forms_1702` WRITE;
/*!40000 ALTER TABLE `forms_1702` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1702` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1782`
--

DROP TABLE IF EXISTS `forms_1782`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1782` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` int(11) NOT NULL DEFAULT '422',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1782`
--

LOCK TABLES `forms_1782` WRITE;
/*!40000 ALTER TABLE `forms_1782` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1782` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1872`
--

DROP TABLE IF EXISTS `forms_1872`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1872` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1872`
--

LOCK TABLES `forms_1872` WRITE;
/*!40000 ALTER TABLE `forms_1872` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1872` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1902`
--

DROP TABLE IF EXISTS `forms_1902`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1902` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1902`
--

LOCK TABLES `forms_1902` WRITE;
/*!40000 ALTER TABLE `forms_1902` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1902` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1912`
--

DROP TABLE IF EXISTS `forms_1912`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1912` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1912`
--

LOCK TABLES `forms_1912` WRITE;
/*!40000 ALTER TABLE `forms_1912` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1912` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_1932`
--

DROP TABLE IF EXISTS `forms_1932`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_1932` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_1932`
--

LOCK TABLES `forms_1932` WRITE;
/*!40000 ALTER TABLE `forms_1932` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_1932` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_22`
--

DROP TABLE IF EXISTS `forms_22`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_22` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_22`
--

LOCK TABLES `forms_22` WRITE;
/*!40000 ALTER TABLE `forms_22` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_22` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2292`
--

DROP TABLE IF EXISTS `forms_2292`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2292` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2292`
--

LOCK TABLES `forms_2292` WRITE;
/*!40000 ALTER TABLE `forms_2292` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2292` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2302`
--

DROP TABLE IF EXISTS `forms_2302`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2302` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2302`
--

LOCK TABLES `forms_2302` WRITE;
/*!40000 ALTER TABLE `forms_2302` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2302` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2332`
--

DROP TABLE IF EXISTS `forms_2332`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2332` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2332`
--

LOCK TABLES `forms_2332` WRITE;
/*!40000 ALTER TABLE `forms_2332` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2332` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2342`
--

DROP TABLE IF EXISTS `forms_2342`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2342` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2342`
--

LOCK TABLES `forms_2342` WRITE;
/*!40000 ALTER TABLE `forms_2342` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2342` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2432`
--

DROP TABLE IF EXISTS `forms_2432`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2432` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_radios` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2432`
--

LOCK TABLES `forms_2432` WRITE;
/*!40000 ALTER TABLE `forms_2432` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2432` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2442`
--

DROP TABLE IF EXISTS `forms_2442`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2442` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2442`
--

LOCK TABLES `forms_2442` WRITE;
/*!40000 ALTER TABLE `forms_2442` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2442` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2472`
--

DROP TABLE IF EXISTS `forms_2472`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2472` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2472`
--

LOCK TABLES `forms_2472` WRITE;
/*!40000 ALTER TABLE `forms_2472` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2472` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2482`
--

DROP TABLE IF EXISTS `forms_2482`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2482` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2482`
--

LOCK TABLES `forms_2482` WRITE;
/*!40000 ALTER TABLE `forms_2482` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2482` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2492`
--

DROP TABLE IF EXISTS `forms_2492`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2492` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2492`
--

LOCK TABLES `forms_2492` WRITE;
/*!40000 ALTER TABLE `forms_2492` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2492` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2502`
--

DROP TABLE IF EXISTS `forms_2502`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2502` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` int(11) NOT NULL DEFAULT '732',
  `multiple_radios` int(11) NOT NULL DEFAULT '752',
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Brian Lee` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2502`
--

LOCK TABLES `forms_2502` WRITE;
/*!40000 ALTER TABLE `forms_2502` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2502` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2512`
--

DROP TABLE IF EXISTS `forms_2512`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2512` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2512`
--

LOCK TABLES `forms_2512` WRITE;
/*!40000 ALTER TABLE `forms_2512` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2512` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2522`
--

DROP TABLE IF EXISTS `forms_2522`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2522` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2522`
--

LOCK TABLES `forms_2522` WRITE;
/*!40000 ALTER TABLE `forms_2522` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2522` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2532`
--

DROP TABLE IF EXISTS `forms_2532`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2532` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BAN` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` int(11) NOT NULL DEFAULT '832',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2532`
--

LOCK TABLES `forms_2532` WRITE;
/*!40000 ALTER TABLE `forms_2532` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2532` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2632`
--

DROP TABLE IF EXISTS `forms_2632`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2632` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2632`
--

LOCK TABLES `forms_2632` WRITE;
/*!40000 ALTER TABLE `forms_2632` DISABLE KEYS */;
INSERT INTO `forms_2632` VALUES (2,'test','0000-00-00',0.00),(12,'Brian','0000-00-00',5696.00),(22,'Brian','0000-00-00',5687.00),(32,'test','0000-00-00',9.99),(42,'test','0000-00-00',12.99);
/*!40000 ALTER TABLE `forms_2632` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2662`
--

DROP TABLE IF EXISTS `forms_2662`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2662` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2662`
--

LOCK TABLES `forms_2662` WRITE;
/*!40000 ALTER TABLE `forms_2662` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2662` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2672`
--

DROP TABLE IF EXISTS `forms_2672`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2672` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2672`
--

LOCK TABLES `forms_2672` WRITE;
/*!40000 ALTER TABLE `forms_2672` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2672` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2682`
--

DROP TABLE IF EXISTS `forms_2682`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2682` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2682`
--

LOCK TABLES `forms_2682` WRITE;
/*!40000 ALTER TABLE `forms_2682` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2682` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2692`
--

DROP TABLE IF EXISTS `forms_2692`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2692` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2692`
--

LOCK TABLES `forms_2692` WRITE;
/*!40000 ALTER TABLE `forms_2692` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2692` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2712`
--

DROP TABLE IF EXISTS `forms_2712`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2712` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2712`
--

LOCK TABLES `forms_2712` WRITE;
/*!40000 ALTER TABLE `forms_2712` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2712` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2722`
--

DROP TABLE IF EXISTS `forms_2722`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2722` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2722`
--

LOCK TABLES `forms_2722` WRITE;
/*!40000 ALTER TABLE `forms_2722` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2722` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2742`
--

DROP TABLE IF EXISTS `forms_2742`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2742` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2742`
--

LOCK TABLES `forms_2742` WRITE;
/*!40000 ALTER TABLE `forms_2742` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2742` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2752`
--

DROP TABLE IF EXISTS `forms_2752`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2752` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2752`
--

LOCK TABLES `forms_2752` WRITE;
/*!40000 ALTER TABLE `forms_2752` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2752` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2762`
--

DROP TABLE IF EXISTS `forms_2762`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2762` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2762`
--

LOCK TABLES `forms_2762` WRITE;
/*!40000 ALTER TABLE `forms_2762` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2762` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2772`
--

DROP TABLE IF EXISTS `forms_2772`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2772` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2772`
--

LOCK TABLES `forms_2772` WRITE;
/*!40000 ALTER TABLE `forms_2772` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2772` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2782`
--

DROP TABLE IF EXISTS `forms_2782`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2782` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2782`
--

LOCK TABLES `forms_2782` WRITE;
/*!40000 ALTER TABLE `forms_2782` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2782` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2792`
--

DROP TABLE IF EXISTS `forms_2792`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2792` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2792`
--

LOCK TABLES `forms_2792` WRITE;
/*!40000 ALTER TABLE `forms_2792` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2792` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2802`
--

DROP TABLE IF EXISTS `forms_2802`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2802` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2802`
--

LOCK TABLES `forms_2802` WRITE;
/*!40000 ALTER TABLE `forms_2802` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2802` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2812`
--

DROP TABLE IF EXISTS `forms_2812`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2812` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2812`
--

LOCK TABLES `forms_2812` WRITE;
/*!40000 ALTER TABLE `forms_2812` DISABLE KEYS */;
INSERT INTO `forms_2812` VALUES (2,'Bri-AN',''),(12,'MadBUM','');
/*!40000 ALTER TABLE `forms_2812` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2832`
--

DROP TABLE IF EXISTS `forms_2832`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2832` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2832`
--

LOCK TABLES `forms_2832` WRITE;
/*!40000 ALTER TABLE `forms_2832` DISABLE KEYS */;
INSERT INTO `forms_2832` VALUES (2,'Bri','1012'),(12,'Hey ya','1022');
/*!40000 ALTER TABLE `forms_2832` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2842`
--

DROP TABLE IF EXISTS `forms_2842`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2842` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `BAN` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1122',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2842`
--

LOCK TABLES `forms_2842` WRITE;
/*!40000 ALTER TABLE `forms_2842` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2842` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2852`
--

DROP TABLE IF EXISTS `forms_2852`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2852` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2852`
--

LOCK TABLES `forms_2852` WRITE;
/*!40000 ALTER TABLE `forms_2852` DISABLE KEYS */;
INSERT INTO `forms_2852` VALUES (2,'Brian','1222','1262','Jelly Filled');
/*!40000 ALTER TABLE `forms_2852` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2862`
--

DROP TABLE IF EXISTS `forms_2862`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2862` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `textarea_1` longtext COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1292',
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2862`
--

LOCK TABLES `forms_2862` WRITE;
/*!40000 ALTER TABLE `forms_2862` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2862` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2932`
--

DROP TABLE IF EXISTS `forms_2932`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2932` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2932`
--

LOCK TABLES `forms_2932` WRITE;
/*!40000 ALTER TABLE `forms_2932` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2932` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2942`
--

DROP TABLE IF EXISTS `forms_2942`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2942` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2942`
--

LOCK TABLES `forms_2942` WRITE;
/*!40000 ALTER TABLE `forms_2942` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2942` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_2972`
--

DROP TABLE IF EXISTS `forms_2972`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_2972` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_2972`
--

LOCK TABLES `forms_2972` WRITE;
/*!40000 ALTER TABLE `forms_2972` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_2972` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3002`
--

DROP TABLE IF EXISTS `forms_3002`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3002` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3002`
--

LOCK TABLES `forms_3002` WRITE;
/*!40000 ALTER TABLE `forms_3002` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3002` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3022`
--

DROP TABLE IF EXISTS `forms_3022`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3022` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3022`
--

LOCK TABLES `forms_3022` WRITE;
/*!40000 ALTER TABLE `forms_3022` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3022` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3042`
--

DROP TABLE IF EXISTS `forms_3042`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3042` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3042`
--

LOCK TABLES `forms_3042` WRITE;
/*!40000 ALTER TABLE `forms_3042` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3042` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3052`
--

DROP TABLE IF EXISTS `forms_3052`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3052` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3052`
--

LOCK TABLES `forms_3052` WRITE;
/*!40000 ALTER TABLE `forms_3052` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3052` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3062`
--

DROP TABLE IF EXISTS `forms_3062`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3062` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3062`
--

LOCK TABLES `forms_3062` WRITE;
/*!40000 ALTER TABLE `forms_3062` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3062` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3072_archive`
--

DROP TABLE IF EXISTS `forms_3072_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3072_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3072_archive`
--

LOCK TABLES `forms_3072_archive` WRITE;
/*!40000 ALTER TABLE `forms_3072_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3072_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3082`
--

DROP TABLE IF EXISTS `forms_3082`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3082` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1442',
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3082`
--

LOCK TABLES `forms_3082` WRITE;
/*!40000 ALTER TABLE `forms_3082` DISABLE KEYS */;
INSERT INTO `forms_3082` VALUES (2,NULL,NULL,'1442','1462','1482'),(12,NULL,NULL,'1442','1462','1482'),(22,NULL,NULL,'','1452','1482'),(32,NULL,NULL,'1442','1452','1482');
/*!40000 ALTER TABLE `forms_3082` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3082_archive`
--

DROP TABLE IF EXISTS `forms_3082_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3082_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3082_archive`
--

LOCK TABLES `forms_3082_archive` WRITE;
/*!40000 ALTER TABLE `forms_3082_archive` DISABLE KEYS */;
INSERT INTO `forms_3082_archive` VALUES (2,2,NULL,NULL,'call me ishmael'),(12,12,NULL,NULL,'call ');
/*!40000 ALTER TABLE `forms_3082_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3092`
--

DROP TABLE IF EXISTS `forms_3092`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3092` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3092`
--

LOCK TABLES `forms_3092` WRITE;
/*!40000 ALTER TABLE `forms_3092` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3092` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3092_archive`
--

DROP TABLE IF EXISTS `forms_3092_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3092_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3092_archive`
--

LOCK TABLES `forms_3092_archive` WRITE;
/*!40000 ALTER TABLE `forms_3092_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3092_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3102_archive`
--

DROP TABLE IF EXISTS `forms_3102_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3102_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3102_archive`
--

LOCK TABLES `forms_3102_archive` WRITE;
/*!40000 ALTER TABLE `forms_3102_archive` DISABLE KEYS */;
INSERT INTO `forms_3102_archive` VALUES (2,2,NULL,NULL,'','','','','',''),(12,12,NULL,NULL,'','','','','',''),(22,22,NULL,NULL,'','','','','',''),(32,32,NULL,NULL,'','','','','',''),(42,42,NULL,NULL,'','','','','',''),(52,52,NULL,NULL,'','','','','',''),(53,62,NULL,NULL,'Anthony Kong','Anthony Kong','1502,1512','akongx@gmail.com','test','1853'),(54,63,NULL,NULL,'Brian','frgr','1512','dgdsgrg@gmail.com','Brian','1855');
/*!40000 ALTER TABLE `forms_3102_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3112`
--

DROP TABLE IF EXISTS `forms_3112`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3112` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1532',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3112`
--

LOCK TABLES `forms_3112` WRITE;
/*!40000 ALTER TABLE `forms_3112` DISABLE KEYS */;
INSERT INTO `forms_3112` VALUES (2,'test',NULL,NULL,'1532');
/*!40000 ALTER TABLE `forms_3112` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3112_archive`
--

DROP TABLE IF EXISTS `forms_3112_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3112_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3112_archive`
--

LOCK TABLES `forms_3112_archive` WRITE;
/*!40000 ALTER TABLE `forms_3112_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3112_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3122`
--

DROP TABLE IF EXISTS `forms_3122`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3122` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1552',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3122`
--

LOCK TABLES `forms_3122` WRITE;
/*!40000 ALTER TABLE `forms_3122` DISABLE KEYS */;
INSERT INTO `forms_3122` VALUES (2,'gfgf',NULL,NULL,'1552');
/*!40000 ALTER TABLE `forms_3122` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3122_archive`
--

DROP TABLE IF EXISTS `forms_3122_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3122_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3122_archive`
--

LOCK TABLES `forms_3122_archive` WRITE;
/*!40000 ALTER TABLE `forms_3122_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3122_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3132`
--

DROP TABLE IF EXISTS `forms_3132`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3132` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1572',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3132`
--

LOCK TABLES `forms_3132` WRITE;
/*!40000 ALTER TABLE `forms_3132` DISABLE KEYS */;
INSERT INTO `forms_3132` VALUES (2,NULL,NULL,'Brian','1562'),(12,NULL,NULL,'test','1572'),(22,NULL,NULL,'f','1572');
/*!40000 ALTER TABLE `forms_3132` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3132_archive`
--

DROP TABLE IF EXISTS `forms_3132_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3132_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3132_archive`
--

LOCK TABLES `forms_3132_archive` WRITE;
/*!40000 ALTER TABLE `forms_3132_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3132_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3142`
--

DROP TABLE IF EXISTS `forms_3142`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3142` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1592',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3142`
--

LOCK TABLES `forms_3142` WRITE;
/*!40000 ALTER TABLE `forms_3142` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3142` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3142_archive`
--

DROP TABLE IF EXISTS `forms_3142_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3142_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3142_archive`
--

LOCK TABLES `forms_3142_archive` WRITE;
/*!40000 ALTER TABLE `forms_3142_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3142_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3152`
--

DROP TABLE IF EXISTS `forms_3152`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3152` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1612',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3152`
--

LOCK TABLES `forms_3152` WRITE;
/*!40000 ALTER TABLE `forms_3152` DISABLE KEYS */;
INSERT INTO `forms_3152` VALUES (2,NULL,NULL,'fdsfg','1602'),(12,NULL,NULL,'test','1612');
/*!40000 ALTER TABLE `forms_3152` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3152_archive`
--

DROP TABLE IF EXISTS `forms_3152_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3152_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3152_archive`
--

LOCK TABLES `forms_3152_archive` WRITE;
/*!40000 ALTER TABLE `forms_3152_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3152_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3162`
--

DROP TABLE IF EXISTS `forms_3162`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3162` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3162`
--

LOCK TABLES `forms_3162` WRITE;
/*!40000 ALTER TABLE `forms_3162` DISABLE KEYS */;
INSERT INTO `forms_3162` VALUES (2,'fgghfdgh',NULL,NULL,'brian.hk.lee@gmail.com','2'),(12,'blah',NULL,NULL,'bri@gmail.com','10');
/*!40000 ALTER TABLE `forms_3162` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3162_archive`
--

DROP TABLE IF EXISTS `forms_3162_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3162_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3162_archive`
--

LOCK TABLES `forms_3162_archive` WRITE;
/*!40000 ALTER TABLE `forms_3162_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3162_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3172`
--

DROP TABLE IF EXISTS `forms_3172`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3172` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3172`
--

LOCK TABLES `forms_3172` WRITE;
/*!40000 ALTER TABLE `forms_3172` DISABLE KEYS */;
INSERT INTO `forms_3172` VALUES (2,NULL,NULL,''),(12,NULL,NULL,''),(22,NULL,NULL,''),(32,NULL,NULL,''),(42,NULL,NULL,'grgrg'),(52,NULL,NULL,'gandalf'),(62,NULL,NULL,'saruman'),(72,NULL,NULL,'aragorn'),(82,NULL,NULL,'Test');
/*!40000 ALTER TABLE `forms_3172` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3172_archive`
--

DROP TABLE IF EXISTS `forms_3172_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3172_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` time NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=443 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3172_archive`
--

LOCK TABLES `forms_3172_archive` WRITE;
/*!40000 ALTER TABLE `forms_3172_archive` DISABLE KEYS */;
INSERT INTO `forms_3172_archive` VALUES (2,2,NULL,NULL,'1652','','00:00:00',0.00,'','',''),(12,12,NULL,NULL,'1652','','00:00:00',0.00,'','',''),(32,2,NULL,NULL,'','Bri','00:00:00',0.00,'','',''),(42,12,NULL,NULL,'','','00:00:00',0.00,'','',''),(52,22,NULL,NULL,'','grgr','00:00:00',0.00,'','',''),(62,2,NULL,NULL,'','','00:00:00',0.00,'','',''),(72,12,NULL,NULL,'','','00:00:00',0.00,'','',''),(82,22,NULL,NULL,'','','00:00:00',0.00,'','',''),(92,2,NULL,NULL,'','','00:00:00',0.00,'','',''),(102,12,NULL,NULL,'','','00:00:00',0.00,'','',''),(112,22,NULL,NULL,'','','00:00:00',0.00,'','',''),(122,32,NULL,NULL,'','','00:00:00',23.00,'','',''),(162,2,NULL,NULL,'','','00:00:00',0.00,'','',''),(172,12,NULL,NULL,'','','00:00:00',0.00,'','',''),(182,22,NULL,NULL,'','','00:00:00',0.00,'','',''),(192,32,NULL,NULL,'','','00:00:00',0.00,'','',''),(202,42,NULL,NULL,'','','00:00:00',0.00,'(650) 235-5552','',''),(232,2,NULL,NULL,'','','00:00:00',0.00,'','',''),(242,12,NULL,NULL,'','','00:00:00',0.00,'','',''),(252,22,NULL,NULL,'','','00:00:00',0.00,'','',''),(262,32,NULL,NULL,'','','00:00:00',0.00,'','',''),(272,42,NULL,NULL,'','','00:00:00',0.00,'','',''),(282,52,NULL,NULL,'','','00:00:00',0.00,'','',''),(302,2,NULL,NULL,'','','00:00:00',0.00,'','',''),(312,12,NULL,NULL,'','','00:00:00',0.00,'','',''),(322,22,NULL,NULL,'','','00:00:00',0.00,'','',''),(332,32,NULL,NULL,'','','00:00:00',0.00,'','',''),(342,42,NULL,NULL,'','','00:00:00',0.00,'','',''),(352,52,NULL,NULL,'','','00:00:00',0.00,'','',''),(362,62,NULL,NULL,'','','00:00:00',0.00,'','mordor',''),(372,2,NULL,NULL,'','','00:00:00',0.00,'','',''),(382,12,NULL,NULL,'','','00:00:00',0.00,'','',''),(392,22,NULL,NULL,'','','00:00:00',0.00,'','',''),(402,32,NULL,NULL,'','','00:00:00',0.00,'','',''),(412,42,NULL,NULL,'','','00:00:00',0.00,'','','brian.hk.lee@gmail.com'),(422,52,NULL,NULL,'','','00:00:00',0.00,'','','johndoe@example.com'),(432,62,NULL,NULL,'','','00:00:00',0.00,'','','saruman@mordor.com'),(442,72,NULL,NULL,'','','00:00:00',0.00,'','','lord@therings.com');
/*!40000 ALTER TABLE `forms_3172_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3182`
--

DROP TABLE IF EXISTS `forms_3182`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3182` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3182`
--

LOCK TABLES `forms_3182` WRITE;
/*!40000 ALTER TABLE `forms_3182` DISABLE KEYS */;
INSERT INTO `forms_3182` VALUES (2,NULL,NULL,'Pikachu','(650) 435-0989');
/*!40000 ALTER TABLE `forms_3182` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3182_archive`
--

DROP TABLE IF EXISTS `forms_3182_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3182_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3182_archive`
--

LOCK TABLES `forms_3182_archive` WRITE;
/*!40000 ALTER TABLE `forms_3182_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3182_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3192`
--

DROP TABLE IF EXISTS `forms_3192`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3192` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3192`
--

LOCK TABLES `forms_3192` WRITE;
/*!40000 ALTER TABLE `forms_3192` DISABLE KEYS */;
INSERT INTO `forms_3192` VALUES (2,'test',NULL,NULL,'1722'),(12,'test2',NULL,NULL,'1742');
/*!40000 ALTER TABLE `forms_3192` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3192_archive`
--

DROP TABLE IF EXISTS `forms_3192_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3192_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3192_archive`
--

LOCK TABLES `forms_3192_archive` WRITE;
/*!40000 ALTER TABLE `forms_3192_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3192_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3222`
--

DROP TABLE IF EXISTS `forms_3222`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3222` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3222`
--

LOCK TABLES `forms_3222` WRITE;
/*!40000 ALTER TABLE `forms_3222` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3222` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3222_archive`
--

DROP TABLE IF EXISTS `forms_3222_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3222_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3222_archive`
--

LOCK TABLES `forms_3222_archive` WRITE;
/*!40000 ALTER TABLE `forms_3222_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3222_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3232`
--

DROP TABLE IF EXISTS `forms_3232`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3232` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1812',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3232`
--

LOCK TABLES `forms_3232` WRITE;
/*!40000 ALTER TABLE `forms_3232` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3232` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3232_archive`
--

DROP TABLE IF EXISTS `forms_3232_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3232_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3232_archive`
--

LOCK TABLES `forms_3232_archive` WRITE;
/*!40000 ALTER TABLE `forms_3232_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3232_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3332_archive`
--

DROP TABLE IF EXISTS `forms_3332_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3332_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3332_archive`
--

LOCK TABLES `forms_3332_archive` WRITE;
/*!40000 ALTER TABLE `forms_3332_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3332_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3342`
--

DROP TABLE IF EXISTS `forms_3342`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3342` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1832',
  `numbers` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3342`
--

LOCK TABLES `forms_3342` WRITE;
/*!40000 ALTER TABLE `forms_3342` DISABLE KEYS */;
INSERT INTO `forms_3342` VALUES (2,'test bri',NULL,NULL,'1822',23.00),(12,'test',NULL,NULL,'1822',56.00);
/*!40000 ALTER TABLE `forms_3342` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3342_archive`
--

DROP TABLE IF EXISTS `forms_3342_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3342_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3342_archive`
--

LOCK TABLES `forms_3342_archive` WRITE;
/*!40000 ALTER TABLE `forms_3342_archive` DISABLE KEYS */;
INSERT INTO `forms_3342_archive` VALUES (2,2,NULL,NULL,'2056-03-04'),(12,12,NULL,NULL,'2019-08-15');
/*!40000 ALTER TABLE `forms_3342_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3352_archive`
--

DROP TABLE IF EXISTS `forms_3352_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3352_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3352_archive`
--

LOCK TABLES `forms_3352_archive` WRITE;
/*!40000 ALTER TABLE `forms_3352_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3352_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3362`
--

DROP TABLE IF EXISTS `forms_3362`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3362` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3362`
--

LOCK TABLES `forms_3362` WRITE;
/*!40000 ALTER TABLE `forms_3362` DISABLE KEYS */;
INSERT INTO `forms_3362` VALUES (2,NULL,NULL,'frgrr'),(12,NULL,NULL,'frodo');
/*!40000 ALTER TABLE `forms_3362` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3362_archive`
--

DROP TABLE IF EXISTS `forms_3362_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3362_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3362_archive`
--

LOCK TABLES `forms_3362_archive` WRITE;
/*!40000 ALTER TABLE `forms_3362_archive` DISABLE KEYS */;
INSERT INTO `forms_3362_archive` VALUES (2,2,NULL,NULL,'','brian.lee@sfgov.org'),(12,12,NULL,NULL,'','fbaggins@gmail.com');
/*!40000 ALTER TABLE `forms_3362_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3372_archive`
--

DROP TABLE IF EXISTS `forms_3372_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3372_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3372_archive`
--

LOCK TABLES `forms_3372_archive` WRITE;
/*!40000 ALTER TABLE `forms_3372_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3372_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3373_archive`
--

DROP TABLE IF EXISTS `forms_3373_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3373_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3373_archive`
--

LOCK TABLES `forms_3373_archive` WRITE;
/*!40000 ALTER TABLE `forms_3373_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3373_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3374_archive`
--

DROP TABLE IF EXISTS `forms_3374_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3374_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3374_archive`
--

LOCK TABLES `forms_3374_archive` WRITE;
/*!40000 ALTER TABLE `forms_3374_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3374_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3375_archive`
--

DROP TABLE IF EXISTS `forms_3375_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3375_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3375_archive`
--

LOCK TABLES `forms_3375_archive` WRITE;
/*!40000 ALTER TABLE `forms_3375_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3375_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3376`
--

DROP TABLE IF EXISTS `forms_3376`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3376` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1843',
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1845',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3376`
--

LOCK TABLES `forms_3376` WRITE;
/*!40000 ALTER TABLE `forms_3376` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3376` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3376_archive`
--

DROP TABLE IF EXISTS `forms_3376_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3376_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3376_archive`
--

LOCK TABLES `forms_3376_archive` WRITE;
/*!40000 ALTER TABLE `forms_3376_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3376_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3377`
--

DROP TABLE IF EXISTS `forms_3377`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3377` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `textarea` longtext COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3377`
--

LOCK TABLES `forms_3377` WRITE;
/*!40000 ALTER TABLE `forms_3377` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3377` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3377_archive`
--

DROP TABLE IF EXISTS `forms_3377_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3377_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3377_archive`
--

LOCK TABLES `forms_3377_archive` WRITE;
/*!40000 ALTER TABLE `forms_3377_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3377_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3378`
--

DROP TABLE IF EXISTS `forms_3378`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3378` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3378`
--

LOCK TABLES `forms_3378` WRITE;
/*!40000 ALTER TABLE `forms_3378` DISABLE KEYS */;
INSERT INTO `forms_3378` VALUES (1,'gandalf',NULL,NULL,'gandalfthewise@yahoo.com','',NULL,'145 penny lane','liverpool','95067','','','Brian Lee'),(2,'Brian Lee',NULL,NULL,'brian.hk.lee@gmail.com','',NULL,'215 Eucalyptus Ave','Hillsborough','94010','','','efr');
/*!40000 ALTER TABLE `forms_3378` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3378_archive`
--

DROP TABLE IF EXISTS `forms_3378_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3378_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3378_archive`
--

LOCK TABLES `forms_3378_archive` WRITE;
/*!40000 ALTER TABLE `forms_3378_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3378_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3379_archive`
--

DROP TABLE IF EXISTS `forms_3379_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3379_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3379_archive`
--

LOCK TABLES `forms_3379_archive` WRITE;
/*!40000 ALTER TABLE `forms_3379_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3379_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3380_archive`
--

DROP TABLE IF EXISTS `forms_3380_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3380_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3380_archive`
--

LOCK TABLES `forms_3380_archive` WRITE;
/*!40000 ALTER TABLE `forms_3380_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3380_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3381`
--

DROP TABLE IF EXISTS `forms_3381`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3381` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3381`
--

LOCK TABLES `forms_3381` WRITE;
/*!40000 ALTER TABLE `forms_3381` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3381` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3381_archive`
--

DROP TABLE IF EXISTS `forms_3381_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3381_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3381_archive`
--

LOCK TABLES `forms_3381_archive` WRITE;
/*!40000 ALTER TABLE `forms_3381_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3381_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3382`
--

DROP TABLE IF EXISTS `forms_3382`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3382` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3382`
--

LOCK TABLES `forms_3382` WRITE;
/*!40000 ALTER TABLE `forms_3382` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3382` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3382_archive`
--

DROP TABLE IF EXISTS `forms_3382_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3382_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3382_archive`
--

LOCK TABLES `forms_3382_archive` WRITE;
/*!40000 ALTER TABLE `forms_3382_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3382_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3383`
--

DROP TABLE IF EXISTS `forms_3383`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3383` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3383`
--

LOCK TABLES `forms_3383` WRITE;
/*!40000 ALTER TABLE `forms_3383` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3383` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3383_archive`
--

DROP TABLE IF EXISTS `forms_3383_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3383_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3383_archive`
--

LOCK TABLES `forms_3383_archive` WRITE;
/*!40000 ALTER TABLE `forms_3383_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3383_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3384_archive`
--

DROP TABLE IF EXISTS `forms_3384_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3384_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3384_archive`
--

LOCK TABLES `forms_3384_archive` WRITE;
/*!40000 ALTER TABLE `forms_3384_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3384_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3385_archive`
--

DROP TABLE IF EXISTS `forms_3385_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3385_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3385_archive`
--

LOCK TABLES `forms_3385_archive` WRITE;
/*!40000 ALTER TABLE `forms_3385_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3385_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3386_archive`
--

DROP TABLE IF EXISTS `forms_3386_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3386_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3386_archive`
--

LOCK TABLES `forms_3386_archive` WRITE;
/*!40000 ALTER TABLE `forms_3386_archive` DISABLE KEYS */;
INSERT INTO `forms_3386_archive` VALUES (1,1,'2019-08-16 22:28:17','2019-08-16 22:28:17','','dgdgd','1848','00:00:00'),(2,2,'2019-08-16 22:28:17','2019-08-16 22:28:17','','6ixgod','1849','00:00:00'),(3,3,'2019-08-16 22:28:17','2019-08-16 22:28:17','','fgrg','1848','17:06:00'),(4,4,'2019-08-16 22:28:17','2019-08-16 22:28:17','','gfgf','1849','16:00:00');
/*!40000 ALTER TABLE `forms_3386_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3387_archive`
--

DROP TABLE IF EXISTS `forms_3387_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3387_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3387_archive`
--

LOCK TABLES `forms_3387_archive` WRITE;
/*!40000 ALTER TABLE `forms_3387_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3387_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3388_archive`
--

DROP TABLE IF EXISTS `forms_3388_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3388_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3388_archive`
--

LOCK TABLES `forms_3388_archive` WRITE;
/*!40000 ALTER TABLE `forms_3388_archive` DISABLE KEYS */;
INSERT INTO `forms_3388_archive` VALUES (1,1,'2019-08-16 21:10:45','2019-08-16 21:10:45','han Jiang','jiang.henry@gmail.com','(510) 388-8679'),(2,2,'2019-08-16 21:10:45','2019-08-16 21:10:45','henry jiang','henry.jiang@sfgov.org','(415) 581-4055');
/*!40000 ALTER TABLE `forms_3388_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3389_archive`
--

DROP TABLE IF EXISTS `forms_3389_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3389_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3389_archive`
--

LOCK TABLES `forms_3389_archive` WRITE;
/*!40000 ALTER TABLE `forms_3389_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3389_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3390`
--

DROP TABLE IF EXISTS `forms_3390`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3390` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3390`
--

LOCK TABLES `forms_3390` WRITE;
/*!40000 ALTER TABLE `forms_3390` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3390` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3390_archive`
--

DROP TABLE IF EXISTS `forms_3390_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3390_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3390_archive`
--

LOCK TABLES `forms_3390_archive` WRITE;
/*!40000 ALTER TABLE `forms_3390_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3390_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3391`
--

DROP TABLE IF EXISTS `forms_3391`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3391` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Zwei',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3391`
--

LOCK TABLES `forms_3391` WRITE;
/*!40000 ALTER TABLE `forms_3391` DISABLE KEYS */;
INSERT INTO `forms_3391` VALUES (1,'','2019-08-28 19:55:29','2019-08-28 19:55:29','',''),(2,'','2019-08-28 19:55:55','2019-08-28 19:55:55','1959','');
/*!40000 ALTER TABLE `forms_3391` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3391_archive`
--

DROP TABLE IF EXISTS `forms_3391_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3391_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3391_archive`
--

LOCK TABLES `forms_3391_archive` WRITE;
/*!40000 ALTER TABLE `forms_3391_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3391_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3392_archive`
--

DROP TABLE IF EXISTS `forms_3392_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3392_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3392_archive`
--

LOCK TABLES `forms_3392_archive` WRITE;
/*!40000 ALTER TABLE `forms_3392_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3392_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3393_archive`
--

DROP TABLE IF EXISTS `forms_3393_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3393_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3393_archive`
--

LOCK TABLES `forms_3393_archive` WRITE;
/*!40000 ALTER TABLE `forms_3393_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3393_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3394_archive`
--

DROP TABLE IF EXISTS `forms_3394_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3394_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3394_archive`
--

LOCK TABLES `forms_3394_archive` WRITE;
/*!40000 ALTER TABLE `forms_3394_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3394_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3395_archive`
--

DROP TABLE IF EXISTS `forms_3395_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3395_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3395_archive`
--

LOCK TABLES `forms_3395_archive` WRITE;
/*!40000 ALTER TABLE `forms_3395_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3395_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3396_archive`
--

DROP TABLE IF EXISTS `forms_3396_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3396_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3396_archive`
--

LOCK TABLES `forms_3396_archive` WRITE;
/*!40000 ALTER TABLE `forms_3396_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3396_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3397_archive`
--

DROP TABLE IF EXISTS `forms_3397_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3397_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3397_archive`
--

LOCK TABLES `forms_3397_archive` WRITE;
/*!40000 ALTER TABLE `forms_3397_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3397_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3398_archive`
--

DROP TABLE IF EXISTS `forms_3398_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3398_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3398_archive`
--

LOCK TABLES `forms_3398_archive` WRITE;
/*!40000 ALTER TABLE `forms_3398_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3398_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3399_archive`
--

DROP TABLE IF EXISTS `forms_3399_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3399_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3399_archive`
--

LOCK TABLES `forms_3399_archive` WRITE;
/*!40000 ALTER TABLE `forms_3399_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3399_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3400`
--

DROP TABLE IF EXISTS `forms_3400`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3400` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1888',
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3400`
--

LOCK TABLES `forms_3400` WRITE;
/*!40000 ALTER TABLE `forms_3400` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3400` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3400_archive`
--

DROP TABLE IF EXISTS `forms_3400_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3400_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3400_archive`
--

LOCK TABLES `forms_3400_archive` WRITE;
/*!40000 ALTER TABLE `forms_3400_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3400_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3401_archive`
--

DROP TABLE IF EXISTS `forms_3401_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3401_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3401_archive`
--

LOCK TABLES `forms_3401_archive` WRITE;
/*!40000 ALTER TABLE `forms_3401_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3401_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3402_archive`
--

DROP TABLE IF EXISTS `forms_3402_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3402_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3402_archive`
--

LOCK TABLES `forms_3402_archive` WRITE;
/*!40000 ALTER TABLE `forms_3402_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3402_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3403`
--

DROP TABLE IF EXISTS `forms_3403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3403` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3403`
--

LOCK TABLES `forms_3403` WRITE;
/*!40000 ALTER TABLE `forms_3403` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3403` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3403_archive`
--

DROP TABLE IF EXISTS `forms_3403_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3403_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3403_archive`
--

LOCK TABLES `forms_3403_archive` WRITE;
/*!40000 ALTER TABLE `forms_3403_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3403_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3404`
--

DROP TABLE IF EXISTS `forms_3404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3404` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3404`
--

LOCK TABLES `forms_3404` WRITE;
/*!40000 ALTER TABLE `forms_3404` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3404` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3404_archive`
--

DROP TABLE IF EXISTS `forms_3404_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3404_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3404_archive`
--

LOCK TABLES `forms_3404_archive` WRITE;
/*!40000 ALTER TABLE `forms_3404_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3404_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3405`
--

DROP TABLE IF EXISTS `forms_3405`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3405` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3405`
--

LOCK TABLES `forms_3405` WRITE;
/*!40000 ALTER TABLE `forms_3405` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3405` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3405_archive`
--

DROP TABLE IF EXISTS `forms_3405_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3405_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3405_archive`
--

LOCK TABLES `forms_3405_archive` WRITE;
/*!40000 ALTER TABLE `forms_3405_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3405_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3406_archive`
--

DROP TABLE IF EXISTS `forms_3406_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3406_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3406_archive`
--

LOCK TABLES `forms_3406_archive` WRITE;
/*!40000 ALTER TABLE `forms_3406_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3406_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3407`
--

DROP TABLE IF EXISTS `forms_3407`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3407` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3407`
--

LOCK TABLES `forms_3407` WRITE;
/*!40000 ALTER TABLE `forms_3407` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3407` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3407_archive`
--

DROP TABLE IF EXISTS `forms_3407_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3407_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3407_archive`
--

LOCK TABLES `forms_3407_archive` WRITE;
/*!40000 ALTER TABLE `forms_3407_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3407_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3408`
--

DROP TABLE IF EXISTS `forms_3408`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3408` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foo1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `foo2` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3408`
--

LOCK TABLES `forms_3408` WRITE;
/*!40000 ALTER TABLE `forms_3408` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3408` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3408_archive`
--

DROP TABLE IF EXISTS `forms_3408_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3408_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3408_archive`
--

LOCK TABLES `forms_3408_archive` WRITE;
/*!40000 ALTER TABLE `forms_3408_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3408_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3409`
--

DROP TABLE IF EXISTS `forms_3409`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3409` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3409`
--

LOCK TABLES `forms_3409` WRITE;
/*!40000 ALTER TABLE `forms_3409` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3409` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3409_archive`
--

DROP TABLE IF EXISTS `forms_3409_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3409_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3409_archive`
--

LOCK TABLES `forms_3409_archive` WRITE;
/*!40000 ALTER TABLE `forms_3409_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3409_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3410`
--

DROP TABLE IF EXISTS `forms_3410`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3410` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3410`
--

LOCK TABLES `forms_3410` WRITE;
/*!40000 ALTER TABLE `forms_3410` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3410` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3410_archive`
--

DROP TABLE IF EXISTS `forms_3410_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3410_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3410_archive`
--

LOCK TABLES `forms_3410_archive` WRITE;
/*!40000 ALTER TABLE `forms_3410_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3410_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3411`
--

DROP TABLE IF EXISTS `forms_3411`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3411` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3411`
--

LOCK TABLES `forms_3411` WRITE;
/*!40000 ALTER TABLE `forms_3411` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3411` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3411_archive`
--

DROP TABLE IF EXISTS `forms_3411_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3411_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3411_archive`
--

LOCK TABLES `forms_3411_archive` WRITE;
/*!40000 ALTER TABLE `forms_3411_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3411_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3412`
--

DROP TABLE IF EXISTS `forms_3412`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3412` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3412`
--

LOCK TABLES `forms_3412` WRITE;
/*!40000 ALTER TABLE `forms_3412` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3412` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3412_archive`
--

DROP TABLE IF EXISTS `forms_3412_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3412_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3412_archive`
--

LOCK TABLES `forms_3412_archive` WRITE;
/*!40000 ALTER TABLE `forms_3412_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3412_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3413_archive`
--

DROP TABLE IF EXISTS `forms_3413_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3413_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3413_archive`
--

LOCK TABLES `forms_3413_archive` WRITE;
/*!40000 ALTER TABLE `forms_3413_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3413_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3414`
--

DROP TABLE IF EXISTS `forms_3414`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3414` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3414`
--

LOCK TABLES `forms_3414` WRITE;
/*!40000 ALTER TABLE `forms_3414` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3414` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3414_archive`
--

DROP TABLE IF EXISTS `forms_3414_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3414_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3414_archive`
--

LOCK TABLES `forms_3414_archive` WRITE;
/*!40000 ALTER TABLE `forms_3414_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3414_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3415`
--

DROP TABLE IF EXISTS `forms_3415`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3415` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3415`
--

LOCK TABLES `forms_3415` WRITE;
/*!40000 ALTER TABLE `forms_3415` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3415` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3415_archive`
--

DROP TABLE IF EXISTS `forms_3415_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3415_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3415_archive`
--

LOCK TABLES `forms_3415_archive` WRITE;
/*!40000 ALTER TABLE `forms_3415_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3415_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3416`
--

DROP TABLE IF EXISTS `forms_3416`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3416` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3416`
--

LOCK TABLES `forms_3416` WRITE;
/*!40000 ALTER TABLE `forms_3416` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3416` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3416_archive`
--

DROP TABLE IF EXISTS `forms_3416_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3416_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3416_archive`
--

LOCK TABLES `forms_3416_archive` WRITE;
/*!40000 ALTER TABLE `forms_3416_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3416_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3417`
--

DROP TABLE IF EXISTS `forms_3417`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3417` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3417`
--

LOCK TABLES `forms_3417` WRITE;
/*!40000 ALTER TABLE `forms_3417` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3417` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3417_archive`
--

DROP TABLE IF EXISTS `forms_3417_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3417_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3417_archive`
--

LOCK TABLES `forms_3417_archive` WRITE;
/*!40000 ALTER TABLE `forms_3417_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3417_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3418`
--

DROP TABLE IF EXISTS `forms_3418`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3418` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3418`
--

LOCK TABLES `forms_3418` WRITE;
/*!40000 ALTER TABLE `forms_3418` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3418` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3418_archive`
--

DROP TABLE IF EXISTS `forms_3418_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3418_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3418_archive`
--

LOCK TABLES `forms_3418_archive` WRITE;
/*!40000 ALTER TABLE `forms_3418_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3418_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3419`
--

DROP TABLE IF EXISTS `forms_3419`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3419` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3419`
--

LOCK TABLES `forms_3419` WRITE;
/*!40000 ALTER TABLE `forms_3419` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3419` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3419_archive`
--

DROP TABLE IF EXISTS `forms_3419_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3419_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3419_archive`
--

LOCK TABLES `forms_3419_archive` WRITE;
/*!40000 ALTER TABLE `forms_3419_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3419_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3420`
--

DROP TABLE IF EXISTS `forms_3420`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3420` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3420`
--

LOCK TABLES `forms_3420` WRITE;
/*!40000 ALTER TABLE `forms_3420` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3420` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3420_archive`
--

DROP TABLE IF EXISTS `forms_3420_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3420_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3420_archive`
--

LOCK TABLES `forms_3420_archive` WRITE;
/*!40000 ALTER TABLE `forms_3420_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3420_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3421`
--

DROP TABLE IF EXISTS `forms_3421`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3421` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3421`
--

LOCK TABLES `forms_3421` WRITE;
/*!40000 ALTER TABLE `forms_3421` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3421` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3421_archive`
--

DROP TABLE IF EXISTS `forms_3421_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3421_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3421_archive`
--

LOCK TABLES `forms_3421_archive` WRITE;
/*!40000 ALTER TABLE `forms_3421_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3421_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3422`
--

DROP TABLE IF EXISTS `forms_3422`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3422` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1934',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3422`
--

LOCK TABLES `forms_3422` WRITE;
/*!40000 ALTER TABLE `forms_3422` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3422` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3422_archive`
--

DROP TABLE IF EXISTS `forms_3422_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3422_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3422_archive`
--

LOCK TABLES `forms_3422_archive` WRITE;
/*!40000 ALTER TABLE `forms_3422_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3422_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3423`
--

DROP TABLE IF EXISTS `forms_3423`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3423` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paragraph_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mailing_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `also_address_of_adu` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_address_street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3423`
--

LOCK TABLES `forms_3423` WRITE;
/*!40000 ALTER TABLE `forms_3423` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3423` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3423_archive`
--

DROP TABLE IF EXISTS `forms_3423_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3423_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ready_to_apply` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3423_archive`
--

LOCK TABLES `forms_3423_archive` WRITE;
/*!40000 ALTER TABLE `forms_3423_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3423_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3424_archive`
--

DROP TABLE IF EXISTS `forms_3424_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3424_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3424_archive`
--

LOCK TABLES `forms_3424_archive` WRITE;
/*!40000 ALTER TABLE `forms_3424_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3424_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3425`
--

DROP TABLE IF EXISTS `forms_3425`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3425` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1948',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3425`
--

LOCK TABLES `forms_3425` WRITE;
/*!40000 ALTER TABLE `forms_3425` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3425` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3425_archive`
--

DROP TABLE IF EXISTS `forms_3425_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3425_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3425_archive`
--

LOCK TABLES `forms_3425_archive` WRITE;
/*!40000 ALTER TABLE `forms_3425_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3425_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3426_archive`
--

DROP TABLE IF EXISTS `forms_3426_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3426_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3426_archive`
--

LOCK TABLES `forms_3426_archive` WRITE;
/*!40000 ALTER TABLE `forms_3426_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3426_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3427`
--

DROP TABLE IF EXISTS `forms_3427`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3427` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3427`
--

LOCK TABLES `forms_3427` WRITE;
/*!40000 ALTER TABLE `forms_3427` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3427` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3427_archive`
--

DROP TABLE IF EXISTS `forms_3427_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3427_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3427_archive`
--

LOCK TABLES `forms_3427_archive` WRITE;
/*!40000 ALTER TABLE `forms_3427_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3427_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3428`
--

DROP TABLE IF EXISTS `forms_3428`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3428` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3428`
--

LOCK TABLES `forms_3428` WRITE;
/*!40000 ALTER TABLE `forms_3428` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3428` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3428_archive`
--

DROP TABLE IF EXISTS `forms_3428_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3428_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3428_archive`
--

LOCK TABLES `forms_3428_archive` WRITE;
/*!40000 ALTER TABLE `forms_3428_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3428_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3429`
--

DROP TABLE IF EXISTS `forms_3429`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3429` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1954',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3429`
--

LOCK TABLES `forms_3429` WRITE;
/*!40000 ALTER TABLE `forms_3429` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3429` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3429_archive`
--

DROP TABLE IF EXISTS `forms_3429_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3429_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3429_archive`
--

LOCK TABLES `forms_3429_archive` WRITE;
/*!40000 ALTER TABLE `forms_3429_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3429_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3430`
--

DROP TABLE IF EXISTS `forms_3430`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3430` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1956',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3430`
--

LOCK TABLES `forms_3430` WRITE;
/*!40000 ALTER TABLE `forms_3430` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3430` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3430_archive`
--

DROP TABLE IF EXISTS `forms_3430_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3430_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3430_archive`
--

LOCK TABLES `forms_3430_archive` WRITE;
/*!40000 ALTER TABLE `forms_3430_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3430_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3431_archive`
--

DROP TABLE IF EXISTS `forms_3431_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3431_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3431_archive`
--

LOCK TABLES `forms_3431_archive` WRITE;
/*!40000 ALTER TABLE `forms_3431_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3431_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3432`
--

DROP TABLE IF EXISTS `forms_3432`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3432` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3432`
--

LOCK TABLES `forms_3432` WRITE;
/*!40000 ALTER TABLE `forms_3432` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3432` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3432_archive`
--

DROP TABLE IF EXISTS `forms_3432_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3432_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3432_archive`
--

LOCK TABLES `forms_3432_archive` WRITE;
/*!40000 ALTER TABLE `forms_3432_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3432_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3433`
--

DROP TABLE IF EXISTS `forms_3433`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3433` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3433`
--

LOCK TABLES `forms_3433` WRITE;
/*!40000 ALTER TABLE `forms_3433` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3433` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3433_archive`
--

DROP TABLE IF EXISTS `forms_3433_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3433_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3433_archive`
--

LOCK TABLES `forms_3433_archive` WRITE;
/*!40000 ALTER TABLE `forms_3433_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3433_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3434`
--

DROP TABLE IF EXISTS `forms_3434`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3434` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3434`
--

LOCK TABLES `forms_3434` WRITE;
/*!40000 ALTER TABLE `forms_3434` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3434` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3434_archive`
--

DROP TABLE IF EXISTS `forms_3434_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3434_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3434_archive`
--

LOCK TABLES `forms_3434_archive` WRITE;
/*!40000 ALTER TABLE `forms_3434_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3434_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3435`
--

DROP TABLE IF EXISTS `forms_3435`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3435` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3435`
--

LOCK TABLES `forms_3435` WRITE;
/*!40000 ALTER TABLE `forms_3435` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3435` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3435_archive`
--

DROP TABLE IF EXISTS `forms_3435_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3435_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3435_archive`
--

LOCK TABLES `forms_3435_archive` WRITE;
/*!40000 ALTER TABLE `forms_3435_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3435_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3436`
--

DROP TABLE IF EXISTS `forms_3436`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3436` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3436`
--

LOCK TABLES `forms_3436` WRITE;
/*!40000 ALTER TABLE `forms_3436` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3436` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3436_archive`
--

DROP TABLE IF EXISTS `forms_3436_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3436_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3436_archive`
--

LOCK TABLES `forms_3436_archive` WRITE;
/*!40000 ALTER TABLE `forms_3436_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3436_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3437_archive`
--

DROP TABLE IF EXISTS `forms_3437_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3437_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3437_archive`
--

LOCK TABLES `forms_3437_archive` WRITE;
/*!40000 ALTER TABLE `forms_3437_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3437_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3438_archive`
--

DROP TABLE IF EXISTS `forms_3438_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3438_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3438_archive`
--

LOCK TABLES `forms_3438_archive` WRITE;
/*!40000 ALTER TABLE `forms_3438_archive` DISABLE KEYS */;
INSERT INTO `forms_3438_archive` VALUES (1,1,'2019-08-29 01:33:22','2019-08-29 01:33:22','Peewee Sherman','peewee@sherms.com','4156789087'),(2,2,'2019-08-29 01:33:22','2019-08-29 01:33:22','Mr. Rogers','mrrogers@theneighborhood.com','4156789098');
/*!40000 ALTER TABLE `forms_3438_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3439`
--

DROP TABLE IF EXISTS `forms_3439`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3439` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1969',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3439`
--

LOCK TABLES `forms_3439` WRITE;
/*!40000 ALTER TABLE `forms_3439` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3439` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3439_archive`
--

DROP TABLE IF EXISTS `forms_3439_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3439_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3439_archive`
--

LOCK TABLES `forms_3439_archive` WRITE;
/*!40000 ALTER TABLE `forms_3439_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3439_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3440`
--

DROP TABLE IF EXISTS `forms_3440`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3440` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3440`
--

LOCK TABLES `forms_3440` WRITE;
/*!40000 ALTER TABLE `forms_3440` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3440` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3440_archive`
--

DROP TABLE IF EXISTS `forms_3440_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3440_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3440_archive`
--

LOCK TABLES `forms_3440_archive` WRITE;
/*!40000 ALTER TABLE `forms_3440_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3440_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3441`
--

DROP TABLE IF EXISTS `forms_3441`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3441` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3441`
--

LOCK TABLES `forms_3441` WRITE;
/*!40000 ALTER TABLE `forms_3441` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3441` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3441_archive`
--

DROP TABLE IF EXISTS `forms_3441_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3441_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3441_archive`
--

LOCK TABLES `forms_3441_archive` WRITE;
/*!40000 ALTER TABLE `forms_3441_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3441_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3442`
--

DROP TABLE IF EXISTS `forms_3442`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3442` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mailing_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_of_adu_select` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name_6` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_7` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship_to_owner` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_org` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_9` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textarea` text COLLATE utf8_unicode_ci,
  `name_10` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_of_construction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `est_cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_to_build` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name_11` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_12` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_height` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_ground_floor_area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_13` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `multiple_radios_2` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name_14` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_3` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_15` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_4` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_16` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_5` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_17` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_6` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_18` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_7` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_19` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_8` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_20` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_9` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_21` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_10` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_22` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numbers_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_21` decimal(8,2) NOT NULL,
  `numbers_22` decimal(8,2) NOT NULL,
  `numbers_23` decimal(8,2) NOT NULL,
  `multiple_checkboxes_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2788',
  `paragraph_html_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3442`
--

LOCK TABLES `forms_3442` WRITE;
/*!40000 ALTER TABLE `forms_3442` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3442` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3442_archive`
--

DROP TABLE IF EXISTS `forms_3442_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3442_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paragraph_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3442_archive`
--

LOCK TABLES `forms_3442_archive` WRITE;
/*!40000 ALTER TABLE `forms_3442_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3442_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3443`
--

DROP TABLE IF EXISTS `forms_3443`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3443` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1994',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3443`
--

LOCK TABLES `forms_3443` WRITE;
/*!40000 ALTER TABLE `forms_3443` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3443` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3443_archive`
--

DROP TABLE IF EXISTS `forms_3443_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3443_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3443_archive`
--

LOCK TABLES `forms_3443_archive` WRITE;
/*!40000 ALTER TABLE `forms_3443_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3443_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3444`
--

DROP TABLE IF EXISTS `forms_3444`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3444` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3444`
--

LOCK TABLES `forms_3444` WRITE;
/*!40000 ALTER TABLE `forms_3444` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3444` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3444_archive`
--

DROP TABLE IF EXISTS `forms_3444_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3444_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3444_archive`
--

LOCK TABLES `forms_3444_archive` WRITE;
/*!40000 ALTER TABLE `forms_3444_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3444_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3445`
--

DROP TABLE IF EXISTS `forms_3445`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3445` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1996',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3445`
--

LOCK TABLES `forms_3445` WRITE;
/*!40000 ALTER TABLE `forms_3445` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3445` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3445_archive`
--

DROP TABLE IF EXISTS `forms_3445_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3445_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3445_archive`
--

LOCK TABLES `forms_3445_archive` WRITE;
/*!40000 ALTER TABLE `forms_3445_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3445_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3446`
--

DROP TABLE IF EXISTS `forms_3446`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3446` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3446`
--

LOCK TABLES `forms_3446` WRITE;
/*!40000 ALTER TABLE `forms_3446` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3446` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3446_archive`
--

DROP TABLE IF EXISTS `forms_3446_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3446_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3446_archive`
--

LOCK TABLES `forms_3446_archive` WRITE;
/*!40000 ALTER TABLE `forms_3446_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3446_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3447`
--

DROP TABLE IF EXISTS `forms_3447`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3447` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3447`
--

LOCK TABLES `forms_3447` WRITE;
/*!40000 ALTER TABLE `forms_3447` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3447` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3447_archive`
--

DROP TABLE IF EXISTS `forms_3447_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3447_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3447_archive`
--

LOCK TABLES `forms_3447_archive` WRITE;
/*!40000 ALTER TABLE `forms_3447_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3447_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3448`
--

DROP TABLE IF EXISTS `forms_3448`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3448` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `select_dropdown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3448`
--

LOCK TABLES `forms_3448` WRITE;
/*!40000 ALTER TABLE `forms_3448` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3448` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3448_archive`
--

DROP TABLE IF EXISTS `forms_3448_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3448_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3448_archive`
--

LOCK TABLES `forms_3448_archive` WRITE;
/*!40000 ALTER TABLE `forms_3448_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3448_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3449`
--

DROP TABLE IF EXISTS `forms_3449`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3449` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paragraph_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3449`
--

LOCK TABLES `forms_3449` WRITE;
/*!40000 ALTER TABLE `forms_3449` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3449` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3449_archive`
--

DROP TABLE IF EXISTS `forms_3449_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3449_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3449_archive`
--

LOCK TABLES `forms_3449_archive` WRITE;
/*!40000 ALTER TABLE `forms_3449_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3449_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3450`
--

DROP TABLE IF EXISTS `forms_3450`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3450` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2046',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3450`
--

LOCK TABLES `forms_3450` WRITE;
/*!40000 ALTER TABLE `forms_3450` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3450` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3450_archive`
--

DROP TABLE IF EXISTS `forms_3450_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3450_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3450_archive`
--

LOCK TABLES `forms_3450_archive` WRITE;
/*!40000 ALTER TABLE `forms_3450_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3450_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3451`
--

DROP TABLE IF EXISTS `forms_3451`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3451` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3451`
--

LOCK TABLES `forms_3451` WRITE;
/*!40000 ALTER TABLE `forms_3451` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3451` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3451_archive`
--

DROP TABLE IF EXISTS `forms_3451_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3451_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3451_archive`
--

LOCK TABLES `forms_3451_archive` WRITE;
/*!40000 ALTER TABLE `forms_3451_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3451_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3452`
--

DROP TABLE IF EXISTS `forms_3452`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3452` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3452`
--

LOCK TABLES `forms_3452` WRITE;
/*!40000 ALTER TABLE `forms_3452` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3452` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3457_archive`
--

DROP TABLE IF EXISTS `forms_3457_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3457_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3457_archive`
--

LOCK TABLES `forms_3457_archive` WRITE;
/*!40000 ALTER TABLE `forms_3457_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3457_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3458_archive`
--

DROP TABLE IF EXISTS `forms_3458_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3458_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3458_archive`
--

LOCK TABLES `forms_3458_archive` WRITE;
/*!40000 ALTER TABLE `forms_3458_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3458_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3459_archive`
--

DROP TABLE IF EXISTS `forms_3459_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3459_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3459_archive`
--

LOCK TABLES `forms_3459_archive` WRITE;
/*!40000 ALTER TABLE `forms_3459_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3459_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3460_archive`
--

DROP TABLE IF EXISTS `forms_3460_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3460_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3460_archive`
--

LOCK TABLES `forms_3460_archive` WRITE;
/*!40000 ALTER TABLE `forms_3460_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3460_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3461_archive`
--

DROP TABLE IF EXISTS `forms_3461_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3461_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3461_archive`
--

LOCK TABLES `forms_3461_archive` WRITE;
/*!40000 ALTER TABLE `forms_3461_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3461_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3462_archive`
--

DROP TABLE IF EXISTS `forms_3462_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3462_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3462_archive`
--

LOCK TABLES `forms_3462_archive` WRITE;
/*!40000 ALTER TABLE `forms_3462_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3462_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3463_archive`
--

DROP TABLE IF EXISTS `forms_3463_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3463_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3463_archive`
--

LOCK TABLES `forms_3463_archive` WRITE;
/*!40000 ALTER TABLE `forms_3463_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3463_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3464_archive`
--

DROP TABLE IF EXISTS `forms_3464_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3464_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `checkbox_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3464_archive`
--

LOCK TABLES `forms_3464_archive` WRITE;
/*!40000 ALTER TABLE `forms_3464_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3464_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3465_archive`
--

DROP TABLE IF EXISTS `forms_3465_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3465_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3465_archive`
--

LOCK TABLES `forms_3465_archive` WRITE;
/*!40000 ALTER TABLE `forms_3465_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3465_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3466_archive`
--

DROP TABLE IF EXISTS `forms_3466_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3466_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3466_archive`
--

LOCK TABLES `forms_3466_archive` WRITE;
/*!40000 ALTER TABLE `forms_3466_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3466_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3467`
--

DROP TABLE IF EXISTS `forms_3467`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3467` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3467`
--

LOCK TABLES `forms_3467` WRITE;
/*!40000 ALTER TABLE `forms_3467` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3467` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3467_archive`
--

DROP TABLE IF EXISTS `forms_3467_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3467_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3467_archive`
--

LOCK TABLES `forms_3467_archive` WRITE;
/*!40000 ALTER TABLE `forms_3467_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3467_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3468`
--

DROP TABLE IF EXISTS `forms_3468`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3468` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_of_adu_select` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2194',
  `name_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2196',
  `page_separator_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship_to_owner` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2200',
  `name_of_org` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textarea` longtext COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_construction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `est_cost` decimal(8,2) NOT NULL,
  `time_to_build` decimal(8,2) NOT NULL,
  `page_separator_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `numbers_1` decimal(8,2) NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_2` decimal(8,2) NOT NULL,
  `page_separator_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2209',
  `new_height` decimal(8,2) NOT NULL,
  `new_ground_floor_area` decimal(8,2) NOT NULL,
  `page_separator_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2211',
  `multiple_radios_2` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2213',
  `page_separator_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_3` decimal(8,2) NOT NULL,
  `multiple_radios_3` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2215',
  `numbers_4` decimal(8,2) NOT NULL,
  `page_separator_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_5` decimal(8,2) NOT NULL,
  `multiple_radios_4` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2217',
  `numbers_6` decimal(8,2) NOT NULL,
  `page_separator_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_7` decimal(8,2) NOT NULL,
  `multiple_radios_5` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2219',
  `numbers_8` decimal(8,2) NOT NULL,
  `page_separator_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_9` decimal(8,2) NOT NULL,
  `multiple_radios_6` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2221',
  `numbers_10` decimal(8,2) NOT NULL,
  `page_separator_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_11` decimal(8,2) NOT NULL,
  `multiple_radios_7` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2223',
  `numbers_12` decimal(8,2) NOT NULL,
  `zip_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_13` decimal(8,2) NOT NULL,
  `multiple_radios_8` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2225',
  `numbers_14` decimal(8,2) NOT NULL,
  `page_separator_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_15` decimal(8,2) NOT NULL,
  `multiple_radios_9` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2227',
  `numbers_16` decimal(8,2) NOT NULL,
  `page_separator_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_17` decimal(8,2) NOT NULL,
  `multiple_radios_10` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2229',
  `numbers_18` decimal(8,2) NOT NULL,
  `page_separator_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_20` decimal(8,2) NOT NULL,
  `multiple_radios_11` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2231',
  `numbers_19` decimal(8,2) NOT NULL,
  `page_separator_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_22` decimal(8,2) NOT NULL,
  `multiple_radios_12` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2233',
  `numbers_21` decimal(8,2) NOT NULL,
  `page_separator_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_24` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_13` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2235',
  `numbers_23` decimal(8,2) NOT NULL,
  `multiple_radios_14` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2237',
  `numbers_24` decimal(8,2) NOT NULL,
  `page_separator_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_25` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `text_input_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_25` decimal(8,2) NOT NULL,
  `page_separator_21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_26` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_15` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2244',
  `numbers_26` decimal(8,2) NOT NULL,
  `multiple_radios_16` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2246',
  `numbers_27` decimal(8,2) NOT NULL,
  `multiple_radios_17` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2248',
  `page_separator_22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_27` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_18` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2250',
  `file_upload_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_28` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3468`
--

LOCK TABLES `forms_3468` WRITE;
/*!40000 ALTER TABLE `forms_3468` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3468` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3468_archive`
--

DROP TABLE IF EXISTS `forms_3468_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3468_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3468_archive`
--

LOCK TABLES `forms_3468_archive` WRITE;
/*!40000 ALTER TABLE `forms_3468_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3468_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3469_archive`
--

DROP TABLE IF EXISTS `forms_3469_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3469_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3469_archive`
--

LOCK TABLES `forms_3469_archive` WRITE;
/*!40000 ALTER TABLE `forms_3469_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3469_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3470`
--

DROP TABLE IF EXISTS `forms_3470`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3470` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_of_adu_select` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2254',
  `name_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2256',
  `page_separator_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship_to_owner` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2261',
  `name_of_org` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textarea` longtext COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_construction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `est_cost` decimal(8,2) NOT NULL,
  `time_to_build` decimal(8,2) NOT NULL,
  `page_separator_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `numbers_1` decimal(8,2) NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_2` decimal(8,2) NOT NULL,
  `page_separator_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2270',
  `new_height` decimal(8,2) NOT NULL,
  `new_ground_floor_area` decimal(8,2) NOT NULL,
  `page_separator_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2272',
  `multiple_radios_2` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2274',
  `page_separator_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_3` decimal(8,2) NOT NULL,
  `multiple_radios_3` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2276',
  `numbers_4` decimal(8,2) NOT NULL,
  `page_separator_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_5` decimal(8,2) NOT NULL,
  `multiple_radios_4` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2278',
  `numbers_6` decimal(8,2) NOT NULL,
  `page_separator_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_7` decimal(8,2) NOT NULL,
  `multiple_radios_5` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2280',
  `numbers_8` decimal(8,2) NOT NULL,
  `page_separator_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_9` decimal(8,2) NOT NULL,
  `multiple_radios_6` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2282',
  `numbers_10` decimal(8,2) NOT NULL,
  `page_separator_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_11` decimal(8,2) NOT NULL,
  `multiple_radios_7` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2284',
  `numbers_12` decimal(8,2) NOT NULL,
  `zip_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_13` decimal(8,2) NOT NULL,
  `multiple_radios_8` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2286',
  `numbers_14` decimal(8,2) NOT NULL,
  `page_separator_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_15` decimal(8,2) NOT NULL,
  `multiple_radios_9` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2288',
  `numbers_16` decimal(8,2) NOT NULL,
  `page_separator_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_17` decimal(8,2) NOT NULL,
  `multiple_radios_10` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2290',
  `numbers_18` decimal(8,2) NOT NULL,
  `page_separator_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_20` decimal(8,2) NOT NULL,
  `multiple_radios_11` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2292',
  `numbers_19` decimal(8,2) NOT NULL,
  `page_separator_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_22` decimal(8,2) NOT NULL,
  `multiple_radios_12` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2294',
  `numbers_21` decimal(8,2) NOT NULL,
  `page_separator_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_24` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_13` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2296',
  `numbers_23` decimal(8,2) NOT NULL,
  `multiple_radios_14` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2298',
  `numbers_24` decimal(8,2) NOT NULL,
  `page_separator_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_25` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2303',
  `text_input_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_25` decimal(8,2) NOT NULL,
  `page_separator_21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_26` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_15` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2305',
  `numbers_26` decimal(8,2) NOT NULL,
  `multiple_radios_16` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2307',
  `numbers_27` decimal(8,2) NOT NULL,
  `multiple_radios_17` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2309',
  `page_separator_22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_27` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_18` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2311',
  `file_upload_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_28` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3470`
--

LOCK TABLES `forms_3470` WRITE;
/*!40000 ALTER TABLE `forms_3470` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3470` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3470_archive`
--

DROP TABLE IF EXISTS `forms_3470_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3470_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3470_archive`
--

LOCK TABLES `forms_3470_archive` WRITE;
/*!40000 ALTER TABLE `forms_3470_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3470_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3479`
--

DROP TABLE IF EXISTS `forms_3479`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3479` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_of_adu_select` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2790',
  `name_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2792',
  `page_separator_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship_to_owner` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2796',
  `name_of_org` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textarea` longtext COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_construction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `est_cost` decimal(8,2) NOT NULL,
  `time_to_build` decimal(8,2) NOT NULL,
  `page_separator_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `numbers_1` decimal(8,2) NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_2` decimal(8,2) NOT NULL,
  `page_separator_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2805',
  `new_height` decimal(8,2) NOT NULL,
  `new_ground_floor_area` decimal(8,2) NOT NULL,
  `page_separator_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2807',
  `multiple_radios_2` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2809',
  `page_separator_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_3` decimal(8,2) NOT NULL,
  `multiple_radios_3` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2811',
  `numbers_4` decimal(8,2) NOT NULL,
  `page_separator_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_5` decimal(8,2) NOT NULL,
  `multiple_radios_4` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2813',
  `numbers_6` decimal(8,2) NOT NULL,
  `page_separator_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_7` decimal(8,2) NOT NULL,
  `multiple_radios_5` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2815',
  `numbers_8` decimal(8,2) NOT NULL,
  `page_separator_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_9` decimal(8,2) NOT NULL,
  `multiple_radios_6` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2817',
  `numbers_10` decimal(8,2) NOT NULL,
  `page_separator_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_11` decimal(8,2) NOT NULL,
  `multiple_radios_7` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2819',
  `numbers_12` decimal(8,2) NOT NULL,
  `zip_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_13` decimal(8,2) NOT NULL,
  `multiple_radios_8` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2821',
  `numbers_14` decimal(8,2) NOT NULL,
  `page_separator_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_15` decimal(8,2) NOT NULL,
  `multiple_radios_9` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2823',
  `numbers_16` decimal(8,2) NOT NULL,
  `page_separator_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_17` decimal(8,2) NOT NULL,
  `multiple_radios_10` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2825',
  `numbers_18` decimal(8,2) NOT NULL,
  `page_separator_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_20` decimal(8,2) NOT NULL,
  `multiple_radios_11` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2827',
  `numbers_19` decimal(8,2) NOT NULL,
  `page_separator_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_22` decimal(8,2) NOT NULL,
  `multiple_radios_12` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2829',
  `numbers_21` decimal(8,2) NOT NULL,
  `page_separator_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_24` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_13` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2831',
  `numbers_23` decimal(8,2) NOT NULL,
  `multiple_radios_14` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2833',
  `numbers_24` decimal(8,2) NOT NULL,
  `page_separator_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_25` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes_1` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2838',
  `text_input_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_25` decimal(8,2) NOT NULL,
  `page_separator_21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_26` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_15` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2840',
  `numbers_26` decimal(8,2) NOT NULL,
  `multiple_radios_16` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2842',
  `numbers_27` decimal(8,2) NOT NULL,
  `multiple_radios_17` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2844',
  `page_separator_22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_27` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_18` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2846',
  `file_upload_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_28` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3479`
--

LOCK TABLES `forms_3479` WRITE;
/*!40000 ALTER TABLE `forms_3479` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3479` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms_3479_archive`
--

DROP TABLE IF EXISTS `forms_3479_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms_3479_archive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_of_adu_select` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_text_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship_to_owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_org` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mailing_address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_input_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textarea` text COLLATE utf8_unicode_ci NOT NULL,
  `paragraph_html_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_construction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `est_cost` decimal(8,2) NOT NULL,
  `time_to_build` decimal(8,2) NOT NULL,
  `page_separator_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` decimal(8,2) NOT NULL,
  `numbers_1` decimal(8,2) NOT NULL,
  `file_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_2` decimal(8,2) NOT NULL,
  `page_separator_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_height` decimal(8,2) NOT NULL,
  `new_ground_floor_area` decimal(8,2) NOT NULL,
  `page_separator_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_3` decimal(8,2) NOT NULL,
  `multiple_radios_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_4` decimal(8,2) NOT NULL,
  `page_separator_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_5` decimal(8,2) NOT NULL,
  `multiple_radios_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_6` decimal(8,2) NOT NULL,
  `page_separator_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_7` decimal(8,2) NOT NULL,
  `multiple_radios_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_8` decimal(8,2) NOT NULL,
  `page_separator_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_9` decimal(8,2) NOT NULL,
  `multiple_radios_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_10` decimal(8,2) NOT NULL,
  `page_separator_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_11` decimal(8,2) NOT NULL,
  `multiple_radios_7` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_12` decimal(8,2) NOT NULL,
  `zip_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_separator_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_13` decimal(8,2) NOT NULL,
  `multiple_radios_8` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_14` decimal(8,2) NOT NULL,
  `page_separator_15` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_15` decimal(8,2) NOT NULL,
  `multiple_radios_9` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_16` decimal(8,2) NOT NULL,
  `page_separator_16` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_21` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_17` decimal(8,2) NOT NULL,
  `multiple_radios_10` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_18` decimal(8,2) NOT NULL,
  `page_separator_17` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_22` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_20` decimal(8,2) NOT NULL,
  `multiple_radios_11` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_19` decimal(8,2) NOT NULL,
  `page_separator_18` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_23` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_22` decimal(8,2) NOT NULL,
  `multiple_radios_12` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_21` decimal(8,2) NOT NULL,
  `page_separator_19` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_24` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_radios_13` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_23` decimal(8,2) NOT NULL,
  `multiple_radios_14` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers_24` decimal(8,2) NOT NULL,
  `page_separator_20` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_25` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `multiple_checkboxes_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms_3479_archive`
--

LOCK TABLES `forms_3479_archive` WRITE;
/*!40000 ALTER TABLE `forms_3479_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms_3479_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (12,'2018_10_26_215727_create_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_form`
--

DROP TABLE IF EXISTS `user_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_form` (
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_form`
--

LOCK TABLES `user_form` WRITE;
/*!40000 ALTER TABLE `user_form` DISABLE KEYS */;
INSERT INTO `user_form` VALUES (1,1,NULL,NULL,NULL),(2,12,'2019-02-12 22:19:19','2019-02-15 17:29:09',NULL),(12,62,'2019-02-14 01:24:54','2019-02-14 01:24:54',NULL),(12,72,'2019-02-14 01:57:41','2019-02-14 01:57:41',NULL),(22,12,'2019-02-16 00:26:42','2019-02-16 00:26:42',NULL),(12,112,'2019-02-16 00:36:31','2019-02-16 00:36:31',NULL),(22,392,'2019-04-04 21:36:28','2019-04-04 21:36:28',NULL),(2,402,'2019-04-07 21:46:17','2019-04-07 21:46:17',NULL),(2,522,'2019-04-17 23:55:33','2019-04-17 23:55:33',NULL),(12,632,'2019-04-22 19:35:31','2019-04-22 19:35:31',NULL),(22,652,'2019-04-23 16:57:51','2019-04-23 16:57:51',NULL),(22,772,'2019-04-25 22:11:16','2019-04-25 22:11:16',NULL),(22,782,'2019-04-25 22:13:58','2019-04-25 22:13:58',NULL),(22,812,'2019-04-25 22:33:40','2019-04-25 22:33:40',NULL),(22,842,'2019-04-26 23:15:32','2019-04-26 23:15:32',NULL),(22,852,'2019-04-29 17:41:25','2019-04-29 17:41:25',NULL),(22,862,'2019-04-29 17:50:46','2019-04-29 17:50:46',NULL),(22,872,'2019-04-29 18:05:52','2019-04-29 18:05:52',NULL),(22,882,'2019-04-29 18:22:27','2019-04-29 18:22:27',NULL),(22,892,'2019-04-29 20:04:00','2019-04-29 20:04:00',NULL),(2,892,'2019-04-29 21:39:27','2019-04-29 21:39:27',NULL),(12,952,'2019-04-30 20:56:16','2019-04-30 20:56:16',NULL),(22,1082,'2019-05-07 21:52:05','2019-05-07 21:52:05',NULL),(22,1092,'2019-05-13 17:41:09','2019-05-13 17:41:09',NULL),(22,1102,'2019-05-13 18:42:54','2019-05-13 18:42:54',NULL),(22,1112,'2019-05-14 00:00:41','2019-05-14 00:00:41',NULL),(22,1122,'2019-05-14 00:30:00','2019-05-14 00:30:00',NULL),(22,1142,'2019-05-21 16:36:36','2019-05-21 16:36:36',NULL),(2,1312,'2019-05-29 19:42:57','2019-05-29 19:42:57',NULL),(22,1332,'2019-06-03 21:58:57','2019-06-03 21:58:57',NULL),(22,1352,'2019-06-03 22:29:01','2019-06-03 22:29:01',NULL),(22,1372,'2019-06-03 22:36:33','2019-06-03 22:36:33',NULL),(22,1412,'2019-06-12 18:08:42','2019-06-12 18:08:42',NULL),(22,1472,'2019-06-26 16:53:50','2019-06-26 16:53:50',NULL),(22,1512,'2019-07-01 17:13:16','2019-07-01 17:13:16',NULL),(22,1522,'2019-07-01 17:28:37','2019-07-01 17:28:37',NULL),(22,1552,'2019-07-01 17:54:46','2019-07-01 17:54:46',NULL),(22,1562,'2019-07-01 17:54:48','2019-07-01 17:54:48',NULL),(22,1662,'2019-07-01 22:43:59','2019-07-01 22:43:59',NULL),(22,1672,'2019-07-02 00:33:15','2019-07-02 00:33:15',NULL),(22,1682,'2019-07-02 00:33:17','2019-07-02 00:33:17',NULL),(22,1692,'2019-07-02 16:22:54','2019-07-02 16:22:54',NULL),(22,1702,'2019-07-02 16:22:56','2019-07-02 16:22:56',NULL),(22,1872,'2019-07-02 21:28:00','2019-07-02 21:28:00',NULL),(22,1912,'2019-07-02 21:35:03','2019-07-02 21:35:03',NULL),(22,1922,'2019-07-02 21:35:36','2019-07-02 21:35:36',NULL),(22,1932,'2019-07-02 21:35:39','2019-07-02 21:35:39',NULL),(22,2332,'2019-07-08 23:29:56','2019-07-08 23:29:56',NULL),(22,2342,'2019-07-08 23:36:03','2019-07-08 23:36:03',NULL),(22,2442,'2019-07-09 16:53:53','2019-07-09 16:53:53',NULL),(22,2472,'2019-07-09 23:55:34','2019-07-09 23:55:34',NULL),(22,2532,'2019-07-12 23:22:21','2019-07-12 23:22:21',NULL),(22,2632,'2019-07-15 23:34:02','2019-07-15 23:34:02',NULL),(22,2772,'2019-07-23 17:07:01','2019-07-23 17:07:01',NULL),(22,2782,'2019-07-23 17:11:51','2019-07-23 17:11:51',NULL),(22,2792,'2019-07-23 17:12:17','2019-07-23 17:12:17',NULL),(22,2812,'2019-07-23 17:17:12','2019-07-23 17:17:12',NULL),(22,2832,'2019-07-24 22:01:25','2019-07-24 22:01:25',NULL),(22,2842,'2019-07-25 19:28:57','2019-07-25 19:28:57',NULL),(22,2852,'2019-07-25 23:32:25','2019-07-25 23:32:25',NULL),(22,2862,'2019-07-25 23:45:27','2019-07-25 23:45:27',NULL),(22,2872,'2019-07-26 22:22:48','2019-07-26 22:22:48',NULL),(22,2892,'2019-07-26 22:22:55','2019-07-26 22:22:55',NULL),(22,2912,'2019-07-26 22:25:15','2019-07-26 22:25:15',NULL),(22,2922,'2019-07-26 22:46:35','2019-07-26 22:46:35',NULL),(22,2932,'2019-07-26 22:47:07','2019-07-26 22:47:07',NULL),(22,3002,'2019-08-01 16:32:28','2019-08-01 16:32:28',NULL),(22,3042,'2019-08-02 21:22:16','2019-08-02 21:22:16',NULL),(22,3082,'2019-08-05 23:36:43','2019-08-05 23:36:43',NULL),(22,3092,'2019-08-06 00:12:23','2019-08-06 00:12:23',NULL),(22,3132,'2019-08-06 19:35:37','2019-08-06 19:35:37',NULL),(22,3142,'2019-08-06 19:37:03','2019-08-06 19:37:03',NULL),(22,3152,'2019-08-06 19:37:46','2019-08-06 19:37:46',NULL),(22,3172,'2019-08-07 17:13:18','2019-08-07 17:13:18',NULL),(22,3182,'2019-08-07 22:24:49','2019-08-07 22:24:49',NULL),(22,3377,'2019-08-15 21:35:54','2019-08-15 21:35:54',NULL),(22,3378,'2019-08-15 21:56:41','2019-08-15 21:56:41',NULL),(12,3391,'2019-08-20 17:55:07','2019-08-20 17:55:07',NULL),(2,3404,'2019-08-23 17:08:06','2019-08-23 17:08:06',NULL),(23,3409,'2019-08-26 23:01:43','2019-08-26 23:01:43',NULL),(23,3411,'2019-08-26 23:13:12','2019-08-26 23:13:12',NULL),(23,3412,'2019-08-26 23:19:05','2019-08-26 23:19:05',NULL),(23,3414,'2019-08-26 23:38:27','2019-08-26 23:38:27',NULL),(23,3415,'2019-08-26 23:42:06','2019-08-26 23:42:06',NULL),(23,3416,'2019-08-26 23:55:35','2019-08-26 23:55:35',NULL),(23,3417,'2019-08-26 23:57:34','2019-08-26 23:57:34',NULL),(23,3418,'2019-08-27 00:00:34','2019-08-27 00:00:34',NULL),(22,3423,'2019-08-27 21:39:04','2019-08-27 21:39:04',NULL),(22,3442,'2019-08-29 18:21:47','2019-08-29 18:21:47',NULL),(23,3443,'2019-08-29 22:35:18','2019-08-29 22:35:18',NULL),(23,3444,'2019-08-29 22:42:59','2019-08-29 22:42:59',NULL),(22,3445,'2019-08-29 22:42:34','2019-08-29 22:42:34',NULL),(23,3447,'2019-08-29 22:44:50','2019-08-29 22:44:50',NULL),(22,3479,'2019-09-04 17:56:08','2019-09-04 17:56:23','2019-09-04 17:56:23');
/*!40000 ALTER TABLE `user_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'John Doe','johndoe@example.com','$2y$10$ATvaEdRHOkj1385QSc309OWYRPq6AesWwp.ZpHr5K8YWi6h/e9dlK','1ddee7aa092ee0ebaed38a3b89f54655207763cb',NULL,'2019-09-04 17:15:16'),(12,'Sasha Magee','sasha.magee@sfgov.org','$2y$12$zPh4LxBOsc5JzpWribbmT.gpYS9J5Spts53vBxpSThIn7.cUjEGsG','f89e11b7887b865074142cba716fd59f4e01ecdd','0000-00-00 00:00:00','2019-08-30 21:28:30'),(22,'Brian Lee','brian.lee@sfgov.org','$2y$12$OXpZQUO8IHWmfk2NzrutiuXFtsTagSYBux0Y7LorutQBzNbvsHm/a','ea741075b09099e6190a28746e0c5cc4a567567b',NULL,'2019-09-04 17:58:32'),(23,'Jim Brodbeck','jim.brodbeck@sfgov.org','$2y$10$YhaNoISoXoZFBlC9HE3cfOuMc2aSlmU/mZBJTK.tr5ME78NH8UuQi','404c3d9eeb8e2ae000d9b7fd2984d2b81288b26e','2019-08-20 02:40:44','2019-08-29 22:48:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-04 11:04:22
