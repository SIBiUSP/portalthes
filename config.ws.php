<?php
/*
*      config.ws.php
*
*      Copyright 2015 diego <tematres@r020.com.ar>
*
*      This program is free software; you can redistribute it and/or modify
*      it under the terms of the GNU General Public License as published by
*      the Free Software Foundation; either version 2 of the License, or
*      (at your option) any later version.
*
*      This program is distributed in the hope that it will be useful,
*      but WITHOUT ANY WARRANTY; without even the implied warranty of
*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*      GNU General Public License for more details.
*
*      You should have received a copy of the GNU General Public License
*      along with this program; if not, write to the Free Software
*      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
*      MA 02110-1301, USA.
*
********************************************************************************************
CONFIGURATION
********************************************************************************************/
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// error_reporting(E_ALL);

$URL_BASE = '';
$lang_tematres = '';
$CFG["ENCODE"] = 'UTF-8';
$lang_tematres = "en_US" ;
$lang_tematres = "es_AR" ;

//  VOCABULARIOS
$CFG_VOCABS["1"]["CODE"]       	= "1";
$CFG_VOCABS["1"]["URL_BASE"]   	= 'http://www.vocabularyserver.com/plos/services.php';
$CFG_VOCABS["1"]["ALPHA"]      	= array();
$CFG_VOCABS["1"]["SHOW_TREE"]  	= 1;
$CFG_VOCABS["1"]["SGS"]		 	= 1; // Acepta sugerencias de términos

/*  In almost cases, you don't need to touch nothing here!!
    Absolute path to the directory where are located /common/include. */

$CFG_URL_PARAM["url_site"]      ='http://vocabularyserver.com/portalthes/';
$CFG_URL_PARAM["title_site"]    = 'Portal de Vocabularios ';
$CFG_URL_PARAM["site_info"]='Lorem ipsum 0';
$CFG_URL_PARAM["site_info_line1"]='Lorem ipsum 1';
$CFG_URL_PARAM["site_info_line2"]='Lorem ipsum 2';

$CFG["DEFVOCAB"]                = "1";                                  //Default vocab
$CFG["MIN_CHAR_SEARCH"]         = 2;                                    //search strings with more than x chars
$CFG["LOCAL_NOTES"]["DEF"]      = "Nota de definición";


$CFG_URL_PARAM["fetchTerm"]		= 'index.php?task=fetchTerm&amp;arg=';
$CFG_URL_PARAM["URIfetchTerm"]	= 'fetchTerm/';
$CFG_URL_PARAM["search"]		= 'index.php?task=search&amp;arg=';
$CFG_URL_PARAM["letter"]		= 'index.php?task=letter&amp;arg=';

if ( !defined('WEBTHES_ABSPATH') )
	/** Use this for version of PHP < 5.3 */
	define('WEBTHES_ABSPATH', dirname(__FILE__));

    require_once("common/lang/$lang_tematres.php");
	include_once('common/vocabularyservices.php');
	include_once('common/portalthes.php');

  	session_start();
	$v=fetchVocabCode($_GET["v"]);
	$_SESSION["vocab"]=$CFG_VOCABS[$v];	
	$URL_BASE=$CFG_VOCABS[$v]["URL_BASE"];

	if (is_array($CFG_VOCABS[$v])) {
        $vocabularyMetadata=fetchVocabularyMetadata($URL_BASE);
        $_SESSION["vocab"]["mail"]  = ((strlen($vocabularyMetadata["adminEmail"])>0) && ($CFG_VOCABS[$v]["SGS"]=="1")) ? $vocabularyMetadata["adminEmail"] : false ;
        $_SESSION["vocab"]["title"] = (string) $vocabularyMetadata["title"];
        $_SESSION["vocab"]["author"] = (string) $vocabularyMetadata["author"];
        $_SESSION["vocab"]["scope"] = xmlentities((string) $vocabularyMetadata["scope"]);
        $_SESSION["vocab"]["lang"] = (string) $vocabularyMetadata["lang"];
        $_SESSION["vocab"]["keywords"] = (string) $vocabularyMetadata["keywords"];
        $_SESSION["vocab"]["lastMod"] = (string) $vocabularyMetadata["lastMod"];
        $_SESSION["vocab"]["cant_terms"] = (string) $vocabularyMetadata["cant_terms"];
    };
?>
