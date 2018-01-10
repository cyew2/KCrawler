<?php
function crawler($link)
{
	$html = new simple_html_dom();
	$dom = new \DOMDocument('1.0', 'UTF-8');
	$internalErrors = libxml_use_internal_errors(true);
	$dom->loadHTMLFile($link);
	libxml_use_internal_errors($internalErrors);
	$dom->preserveWhiteSpace = false;

	if (preg_match("/metrolyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics-body-text');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}
	else if (preg_match("/greatsong.net/i", $link)) {
		$one = get_remote_data($link);
		$two = get_remote_data($link );
		$start = 0;
		$end = 0;
		$lData = "";
		preg_match("/<p class=\"share-lyrics\">/i",$two,$matches,PREG_OFFSET_CAPTURE);
		if($matches)
			$start = $matches[0][1];
		preg_match("/<\/p>/i",$two,$matchesE,PREG_OFFSET_CAPTURE);
		if($matchesE)
			$end = $matchesE[0][1];
		$lData = substr($two,$start,$end-$start);
		return $lData;
	}
	
	else if (preg_match("/parolesmania.com/i", $link))  {
		$one = get_remote_data($link);
		$two = get_remote_data($link );
		$start = 0;
		$end = 0;
		$middle = 0;
		$lData = "";
		$length = strlen($two);
		preg_match("/<div class=\"lyrics-body\"/i",$two,$matches,PREG_OFFSET_CAPTURE);
		if($matches)
			$start = $matches[0][1];
		preg_match("/<div class=\"p402_premium\">/i",$two,$matchesM,PREG_OFFSET_CAPTURE);
		if($matchesM)
			$middle = $matchesM[0][1];
		$temp = substr($two,$middle,$length-$middle-1);
		preg_match("/<\/div>/i",$temp,$matchesE,PREG_OFFSET_CAPTURE);
		if($matchesE)
			$end = $matchesE[0][1];
		if($middle>$start)
			$lData = substr($two,$start,$middle+$end-$start);
		return $lData;
	}
	
	else if (preg_match("/lyricsmania.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='fb-quotable']");		
		if($nodes->length > 0)
			$lData = $dom->saveHTML($nodes->item(0));
		return $lData;
	}
	
	/* french begin*/
	else if (preg_match("/www.paroles.net/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='song-text']");
		if($nodes->length > 0)
			$lData = $dom->saveHTML($nodes->item(0));
		return $lData;
	}
	
	else if (preg_match("/songtextemania.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyrics-body']");
		if($nodes->length > 0)
			$lData = $dom->saveHTML($nodes->item(0));
		return $lData;
	}
	
	else if (preg_match("/lacoccinelle.net/i", $link)) {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='inner']");
		if($nodes->length > 0)
		{
			foreach ($nodes as $node)  {
				$arr = $node->getElementsByTagName("p");
				foreach($arr as $item) {
					$lData .= $dom->saveHTML($item);
				}
			}
		}
		return $lData;
	}
	
	else if (preg_match("/paroles-traductions.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//p[@class='paroles']");
		if($nodes->length > 0)
		{
			$lData = $dom->saveHTML($nodes->item(0));
		}
		return $lData;
	}
	
	else if (preg_match("/songmeanings.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='holder lyric-box']");
		if($nodes->length > 0)
		{
			$lData = $dom->saveHTML($nodes->item(0));
		}
		return $lData;
	}
	
	else if (preg_match("/lyrics-keeper.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@id='lyrics']");
		if($nodes->length > 0)
		{
			$lData = $dom->saveHTML($nodes->item(0));
		}
		return $lData;
	}
	
	else if (preg_match("/famousfix.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//p[@class='font15']");
		if($nodes->length > 0)
		{
			$lData = $dom->saveHTML($nodes->item(0));
		}
		return $lData;
	}
	
	else if (preg_match("/mon-poeme.fr/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='postpoetique']");
		if($nodes->length > 0)
			$lData = $dom->saveHTML($nodes->item(0));
		return $lData;
	}
	
	else if (preg_match("/bestparoles.net/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//p[@class='p-paroles']");
		if($nodes->length > 0)
			$lData = $dom->saveHTML($nodes->item(0));
		return $lData;
	}
	
	else if (preg_match("/azparoles.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//table[@class='menu']");
		if($nodes->length > 0)
			$lData = $dom->saveHTML($nodes->item(1));
		return $lData;
	}
/* french end*/

	else if (preg_match("/diliriklagu.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics-body-text');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricsin.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='post-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/liriklaguindonesia.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class=' clear']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			for($i=1;$i<$arr->length;$i++)
			{
				$lData .= $dom->saveHTML($arr[$i]);
			}
		}	
		return $lData;
	} 

	else if (preg_match("/lyriczz.com/i", $link))  {
		return ""; /* include('simple_html_dom.php');
		$html = file_get_html($link);
		$displaybody = $html->find('div[class=lyriczz]', 0)->plaintext;
		return $displaybody; */
	} 

	else if (preg_match("/letssingit.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
            return "";
		}
		return $mango_div->C14N();
	} 

	else if (preg_match("/lyrics.wikia.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyricbox']");
		if($nodes->length > 0)
		{
			$lData = $dom->saveHTML($nodes->item(0));
		}			
		return $lData;
	}

	else if (preg_match("/opmfans.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-4871323253080413214');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricsfreak.com/i", $link))  {
		$mango_div = $dom->getElementById('content_h');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/genius.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$lData .=  $item->nodeValue;
			}
		}
		return $lData;
	} 

	else if (preg_match("/stlyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('page');
		if(!$mango_div)
		{
		    return "";
		}
		return $mango_div->C14N();
	} 
	else if (preg_match("/lyricstranslate.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='ltf']");
		foreach ($nodes as $i => $node) {
		    $lData .= $node->nodeValue;
		}
		return $lData;
	} 

	else if (preg_match("/flashlyrics.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='main-panel-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("span");
			foreach($arr as $item) {
				$lData .=  $dom->saveHTML($item);
				$lData .= "<br>";
			}
		}
		return $lData;
	} 

	else if (preg_match("/www.songlyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('songLyricsDiv');
		if(!$mango_div)
		{
		     return "";
		}
		return $mango_div->C14N();
	} 

	else if (preg_match("/allthelyrics.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='content-text']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/videokeman.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='art-postcontent']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/opmtunes.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//pre");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	} 

	else if (preg_match("/smule.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyrics content']");
		if($nodes->length > 0)
		{
			$lData = $dom->saveHTML($nodes->item(0));
		}				
		return $lData;
	}
	else if (preg_match("/songtexte.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
			return "";
		}else{
			if(strpos($mango_div->C14N(),"Leider kein songtext vorhanden"))
				return "";
			else
				return $mango_div->C14N();
		}
		
	}

	/**/

/*	else if (preg_match("/azlyrics.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='col-xs-12 col-lg-8 text-center']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("div");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .=  $href;
			}
		}
		return $lData;
	} */

	else if (preg_match("/musixmatch.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);		
		$nodes= $xpath->query("/html/body//div[@class='mxm-lyrics']//div[@class='mxm-lyrics']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("span");		
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .=  $href;
				$lData .=  "<br>";				
			}
		}
		return $lData;
	}

	else if (preg_match("/lyricsmode.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics_text');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 

	else if (preg_match("/elyrics.net/i", $link))  {
		$mango_div = $dom->getElementById('inlyr');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lirik.kapanlagi/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='section-lirik']");
		foreach ($nodes as $node)
		{
			$arr = $node->getElementsByTagName("span");
			foreach($arr as $item) {
			$lData .=  $item->nodeValue;
			$lData .="<br>";
			}
		}		
		return $lData;
	} 

	else if (preg_match("/nurseryrhymes.org/i", $link))  {
		$mango_div = $dom->getElementById('nursery-rhymes-lyrics');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 

	else if (preg_match("/letras.mus./i", $link))  {
		if (preg_match("/traducao.html/i", $link))  {
		    $xpath = new \DOMXpath($dom);
		    $lData = "";
		    $nodes= $xpath->query("/html/body//div[@class='cnt-trad_l']");
			foreach ($nodes as $node) {
				$arr = $node->getElementsByTagName("p");
				foreach($arr as $item) {
					$arrIn = $item->getElementsByTagName("span");
					foreach($arrIn as $itemIn)
					{
						$lData .= $dom->saveHTML($itemIn);
						$lData .= "<br>";
					}
				}	   
			}
		    return $lData;
		}
		else {
		    $xpath = new \DOMXpath($dom);
		    $lData = "";
		    $nodes= $xpath->query("/html/body//div[@class='cnt-letra p402_premium']");
		    foreach ($nodes as $node) {
		        $arr = $node->getElementsByTagName("p");
		        foreach($arr as $item) {
		            $lData .= $dom->saveHTML($item);
		        }
		       $lData .= "<br>";
		    }
		    return $lData;
		}
	}

	else if (preg_match("/mojim.com/i", $link))  {
		$mango_div = $dom->getElementById('fsZx3');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 

	else if (preg_match("/azlyrics.biz/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$lData .=  $dom->saveHTML($item);
			}
		}
		return $lData;
	}

	else if (preg_match("/drlrcs.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

/** -- Spanish sites starting**/

	else if (preg_match("/lyrics.jetmute.com/i", $link))  {
		$mango_div = $dom->getElementById('lyricsText');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	else if (preg_match("/enparranda.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='col-sm-12 letra']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}
	
	else if (preg_match("/www.rockol.it/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='rockol-news-detail-body mod-lyrics scroll-body']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/blogs.20minutos.es/i", $link))  {
        $lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='entry']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("blockquote");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .=  $href;
			}
		}
		return $lData;
	} 

	else if (preg_match("/dicelacancion.com/i", $link))  {
		$mango_div = $dom->getElementById('lyricDLC1');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	else if (preg_match("/quedeletras.com/i", $link))  {
        $lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='col-sm-6']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .=  $href;
			}
		}
		return $lData;
	} 
	
	else if (preg_match("/albumcancionyletra.com/i", $link))  {
		$lData = "";
		$html = file_get_html($link);
		 $x=$html->find('.letra',0);
         $lData=$x->innertext;
		return $lData;
	}
	
	else if (preg_match("/vagalume.com/i", $link))  {
		$mango_div = $dom->getElementById('lyr_original');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	else if (preg_match("/letrasmania.com/i", $link))  {
			$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics-body']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}
	
	else if (preg_match("/portalletras.com/i", $link))  {
		$mango_div = $dom->getElementById('ver-letras-de-canciones');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	
	else if (preg_match("/pasiontango.net/i", $link))  {
		$mango_div = $dom->getElementById('ctl00_ctl00_MainContent_ContentPlaceHolder1_corpo');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	else if (preg_match("/lyrics.az/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	else if (preg_match("/www.karaokeden.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	else if (preg_match("/manutsi.wordpress.com/i", $link))  {
		$mango_div = $dom->getElementById('msgcns!9D7920D0D5F5CBA0!1134');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}
	
	else if (preg_match("/viasona.cat/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//p[@class='contingut_lletra']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}
	
	else if (preg_match("/store.karaokemedia.com/i", $link))  {
        $lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='caja_men']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .=  $href;
			}
		}
		return $lData;
	} 
	
	else if (preg_match("/eu.musikazblai.com/i", $link))  {
        $lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyrics']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("div");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .=  $href;
			}
		}
		return $lData;
	} 
	
	else if (preg_match("/www.cmtv.com.ar/i", $link))  {
		$mango_div = $dom->getElementById('c-letra');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	} 
	
	else if (preg_match("/planet-tango.com/i", $link))  {
			$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}
	
	else if (preg_match("/elcancionerocatolico.blogspot.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-body entry-content']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}
		
	/** -- Spanish sites ending**/

	/**---- Malaysian Sites ---**/

	else if (preg_match("/liriklagu.biz/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry clr']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;           
			}
		}
		return $lData;
	}

	else if (preg_match("/lirik-lagu7.blogspot.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-body entry-content']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
			//return "<br>";
		}
		return $lData;
	}

	else if (preg_match("/iliriklagu.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;             
			}
		}
		return $lData;
	}

	else if (preg_match("/www.islamiclyrics.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='thecontent']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		 return $lData;
	}

	else if (preg_match("/www.justsomelyrics.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$lData .= $dom->saveHTML($item);
			}
		}
		return $lData;
	}

	else if (preg_match("/www.kkbox.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics col-md-12']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/lagukehidupan.blogspot.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-2288129252022001005');
	   if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/www.1liriklagu.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='thecontent']");

		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		 return $lData;
	}

	else if (preg_match("/liriklagu-nasyid.blogspot.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-5870271570941043361');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lirik-lagu-best.blogspot.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-body entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/liriklagumelayubaru.blogspot.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-8032838522725326450');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/www.liriklagumuzika.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-body entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/liriknasyid.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lrk']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
			//return "<br>";
		}
		return $lData;
	}

	else if (preg_match("/www.lyrics.my/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='show_lyric']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lyricsot.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='content']");
		if($nodes->length > 0)
			$lData = $dom->saveHTML($nodes->item(0));	
		return $lData;
	}

	else if (preg_match("/lyricsregime.blogspot.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post hentry']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/mat4nira.wordpress.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/myfavouritesong.wordpress.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			for($i=1;$i<$arr->length;$i++)
			{
				$lData .= $dom->saveHTML($arr[$i]);
			}
		}
		return $lData;
	}

	else if (preg_match("/testicanzoni.mtv.it/i", $link))  {
		$mango_div = $dom->getElementById('testo-container');
		if(!$mango_div)
		{
			return "";
		}
		if(strpos($mango_div, "Sfortunatamente non abbiamo ancora questo testo ma puoi aggiungerlo cliccando qui") !==false)
			return "";
		else
			return $mango_div->C14N();
	}

	else if (preg_match("/www.lyricsbox.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/www.nikeardilla.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='isi_list']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/nonkshe.wordpress.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/ohlirik.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	/*else if (preg_match("/www.paroles-musique.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}*/

	else if (preg_match("/www.printlyrics.net/i", $link))  {
		$mango_div = $dom->getElementById('post-body-1782129817272764535');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/www.quran411.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='surahDetails']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("ol");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/www.rockol.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics_body']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/shulfialaydrus.wordpress.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}


	else if (preg_match("/www.unitedlyrics.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post bar hentry']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/iliriklagu.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lagulagumalaysia.blogspot.my/i", $link))  {
		$mango_div = $dom->getElementById('post-body-2007297059563567940');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/www.liriklagu.asia/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-body entry-content']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/liriklagu.noorjannah.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-3459244087435316195');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/www.lirikmelayu.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='post-content clearfix']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/saelirik.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/satulirik.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='content']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}
	/** -- Malaysian sites ending**/

	// --------------------OTHER SITES----------------------------------------

	else if (preg_match("/sing365.com/i", $link))  {
		$mango_div = $dom->getElementById('main');
		if(!$mango_div)
		{
			return "";
		}		
		return $mango_div->C14N();
		}

	else if (preg_match("/5music.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics']");
		foreach ($nodes as $i => $node) {
			 $lData .= $node->nodeValue;
		}return $lData;
	}

	else if (preg_match("/5sing.kugou.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData ="";
		$nodes= $xpath->query("/html/body//div[@class='lrc_info_clip inspiration-tab-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("div");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}return $lData;
	}

	else if (preg_match("/bengalilyrics24.blogspot.com/i", $link))  {
		$mango_div = $dom->getElementById('lv');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/bestrancelyrics.wordpress.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}return $lData;
	}

	else if (preg_match("/bollymeaning.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-3488072223642979286');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/bollywoodhungama.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='song-lyrics-content entry-content post-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}return $lData;
	}

	else if (preg_match("/bubblegumdancer.com/i", $link))  {
		$mango_div = $dom->getElementById('lyric');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/coveralia.com/i", $link))  {
		$mango_div = $dom->getElementById('HOTWordsTxt');		 
		if(!$mango_div)
		{
		    return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/damnlyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/geetabitan.com/i", $link))  {
		$mango_div = $dom->getElementById('copy');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/geetmanjusha.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entity-description']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/giitaayan.com/i", $link))  {
		$mango_div = $dom->getElementById('ConvertedText'); 
		if(!$mango_div)
		{
		   return "";
		}
		return $mango_div->C14N();		
	}

	else if (preg_match("/www.golyr.de/i", $link))  {
		$mango_div = $dom->getElementById('lyrics');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/gugalyrics.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='content container-block lyrics-block']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/gasazip.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='col-md-8']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/gypsylyrics.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/greeksongs-greekmusic.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//section[@class='entry']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/hindigeetmala.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='song']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("pre");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/hindilyrics.net/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='ten columns']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("pre");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/hinditracks.in/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='thecontent']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/hindiraag.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/houseofbhangra.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='def-block']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/indicine.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='lyrics']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/jah-lyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('content');		 
		if(!$mango_div)
		{
		    return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/karaoketexty.cz/i", $link))  {
		$xpath = new \DOMXpath($dom);
 		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='more_lyrics']");
		foreach ($nodes as $node) {
		    $arr = $node->getElementsByTagName("p");			  
			foreach($arr as $item) {
		      $href =  $item->nodeValue;
			  $lData .= $href;
			  $lData .= "<br>";			
			}
		}
		return $lData;
	}
	
	else if (preg_match("/lololyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics_txt'); 
		if(!$mango_div)
		{
    		return "";
		} 
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricmusicarabic.blogspot.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//span[@class='Apple-style-span']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/lyricsmaya.com/i", $link))  {
		$xpath = new \DOMXpath($dom);
		$lData = "";
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lyrics.pk/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='td-post-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/www.lyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('lyric-body-text');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricsing.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='col-md-12 lyrics_content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lyricsbell.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyrics-col']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lyricsbogie.com/i", $link))  {
		$mango_div = $dom->getElementById('lyricsDiv');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricsdelhi.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-5202677106664092474');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricsintelugu.in/i", $link))  {
		$mango_div = $dom->getElementById('post-body-949258440186183601');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricsio.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='alert-box mb20 italic']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lyricsmint.com/i", $link))  {
		$mango_div = $dom->getElementById('lyric');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/lyricspunjabi.in/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lyricsdesk.blogspot.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='post-body entry-content']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("div");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/lyrster.com/i", $link))  {
		return ""; /* include('simple_html_dom.php');
		$html = file_get_html($link);
		$displaybody = $html->find('div[id=lyrics]', 0)->plaintext;
		return $displaybody; */
	}

	else if (preg_match("/millionsonglyrics.blogspot.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-1692895863508766110');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}
	
	else if (preg_match("/www.letras.com/i", $link))  {
        $lData = "";
       	$html = file_get_html($link);
	 	foreach($html->find('article p') as $e)
	    	$lData.=$e;

        return $lData;
    }

	else if (preg_match("/mldb.org/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//p[@class='songtext']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/musique.ados.fr/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='contenu']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
 	}

/*	else if (preg_match("/www.musica.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//table[@class='ijk']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("font");
			$lData .=  $dom->saveHTML($arr[0]);
			$lData .= "<br>";
		}
		return $lData;
	}*/

	else if (preg_match("/mamalisa.com/i", $link))  {
		$mango_div = $dom->getElementById('lyrics_original_language_lg');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/nitrolyrics.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyricContent']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/oldielyrics.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyrics']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/paadalvarigal.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='entry clearfix']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/phonelyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('prnt');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/pzlyrics.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='entry-content clearfix']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/patdladyparadox.bandcamp.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='tralbumData lyricsText']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/singchinesesongs.com/i", $link))  {
		return ""; /* include('simple_html_dom.php');
		$html = file_get_html($link);
		$displaybody = $html->find('div[id=showdictionarycontent]', 0);
		return $displaybody; */
	}

	else if (preg_match("/singklyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('postTabs_0_3292');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/smarttalkies.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='lyrlist']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/songsuno.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//p[@class='text-align minheight500 lyricspre fontsizefourteen margin-top20']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/sweetslyrics.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);

		$nodes= $xpath->query("/html/body//div[@class='lyric_full_text']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/silenthill.wikia.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='poem']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/swiftlyrics.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='left_box_lyrics']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/tamilpaa.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='info-box white-bg']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}

	else if (preg_match("/telugulyrics.co.in/i", $link))  {
		$mango_div = $dom->getElementById('lyric');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/telugusongslyrics.in/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='box-inner-block']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/trancelyrics.wordpress.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='entry']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/www.tsonglyrics.com/i", $link))  {
		$mango_div = $dom->getElementById('post-body-2404759854755546248');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/testi-canzoni.com/i", $link))  {		
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//div[@class='col-md-8']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("span");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/testiecanzoni.com/i", $link))  {
		$lData = "";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//td[@class='testo']");
		foreach ($nodes as $node) {
			$arr = $node->getElementsByTagName("p");
			foreach($arr as $item) {
				$href =  $item->nodeValue;
				$lData .= $href;
			}
		}
		return $lData;
	}

	else if (preg_match("/www.unp.me/i", $link))  {
		$mango_div = $dom->getElementById('post_message_3346457');
		if(!$mango_div)
		{
			return "";
		}
		return $mango_div->C14N();
	}

	else if (preg_match("/www.animelyrics.com/i", $link))  {
		$lData ="";
		$xpath = new \DOMXpath($dom);
		$nodes= $xpath->query("/html/body//span[@class='lyrics']");
		foreach ($nodes as $i => $node) {
			$lData .= $node->nodeValue;
		}
		return $lData;
	}
	
	else {
		return "";
	}
}

function get_remote_data($url, $post_paramtrs = false) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    if ($post_paramtrs) {
        curl_setopt($c, CURLOPT_POST, TRUE);
        curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
    } curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
    curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
    curl_setopt($c, CURLOPT_MAXREDIRS, 10);
    $follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
    if ($follow_allowed) {
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    }curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
    curl_setopt($c, CURLOPT_REFERER, $url);
    curl_setopt($c, CURLOPT_TIMEOUT, 60);
    curl_setopt($c, CURLOPT_AUTOREFERER, true);
    curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
    $data = curl_exec($c);
    $status = curl_getinfo($c);
    curl_close($c);
    preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
    $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
    $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
    if ($status['http_code'] == 200) {
        return $data;
    } elseif ($status['http_code'] == 301 || $status['http_code'] == 302) {
        if (!$follow_allowed) {
            if (empty($redirURL)) {
                if (!empty($status['redirect_url'])) {
                    $redirURL = $status['redirect_url'];
                }
            } if (empty($redirURL)) {
                preg_match('/(Location:|URI:)(.*?)(\r|\n)/si', $data, $m);
                if (!empty($m[2])) {
                    $redirURL = $m[2];
                }
            } if (empty($redirURL)) {
                preg_match('/href\=\"(.*?)\"(.*?)here\<\/a\>/si', $data, $m);
                if (!empty($m[1])) {
                    $redirURL = $m[1];
                }
            } if (!empty($redirURL)) {
                $t = debug_backtrace();
                return call_user_func($t[0]["function"], trim($redirURL), $post_paramtrs);
            }
        }
    } return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:" . json_encode($status) . "<br/><br/>Last data got<br/>:$data";
}
?>