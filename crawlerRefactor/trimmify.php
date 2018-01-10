<?php
function songNameTrimmer($songName)
{
	$songName = str_replace("%","%25",$songName);
	$songName = str_replace("'","%27",$songName);
	$songName = str_replace('&quot;','%22', $songName);
	$songName = str_replace("&","%26",$songName);
	$songName = str_replace("#","%23",$songName);
	
	$pattern = "/（/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '(',  $songName); 
    }
    
    $pattern = "/\([^\)]*remix[^\(]*\)/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/（[^\)]*remix[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/\([^\)]*remix[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
			$pattern = "/\[[^\]]*remix[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			
			$pattern = "/（[^\)]*remix[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			
			$pattern = "/\[[^\]]*remix[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
    $pattern = "/remix/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
	
	
	$pattern = "/\([^\)]*rmx[^\(]*\)/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/（[^\)]*rmx[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/\([^\)]*rmx[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
			$pattern = "/\[[^\]]*rmx[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			
			$pattern = "/（[^\)]*rmx[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			
			$pattern = "/\[[^\]]*rmx[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}   
    $pattern = "/rmx/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    
	
    $pattern = "/\([^\)]*instrumental[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/（[^\)]*instrumental[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/\([^\)]*instrumental[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
			$pattern = "/\[[^\]]*instrumental[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			$pattern = "/（[^\)]*instrumental[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			$pattern = "/\[[^\]]*instrumental[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
    $pattern = "/instrumental/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    
	
    $pattern = "/\([^\)]*reprise[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/（[^\)]*reprise[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/\([^\)]*reprise[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
			$pattern = "/\[[^\]]*reprise[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/（[^\)]*reprise[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*reprise[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
    $pattern = "/reprise/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
	
	
    $pattern = "/\([^\)]*mix[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/（[^\)]*mix[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/\([^\)]*mix[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
			$pattern = "/\[[^\]]*mix[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/（[^\)]*mix[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*mix[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}	
    $pattern = "/ mix[^a-zA-Z1-9]/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
 
 
    $pattern = "/\([^\)]*version[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/（[^\)]*version[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/\([^\)]*version[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }			
			$pattern = "/\[[^\]]*version[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/（[^\)]*version[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*version[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}       
    $pattern = "/version/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
	
	
	$pattern = "/\([^\)]*edition[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/（[^\)]*edition[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/\([^\)]*edition[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
			$pattern = "/\[[^\]]*edition[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/（[^\)]*edition[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*edition[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			} 
    
	
	
	$pattern = "/\([^\)]*feat[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
    $pattern = "/（[^\)]*feat[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/\([^\)]*feat[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }
			$pattern = "/\[[^\]]*feat[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/（[^\)]*feat[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*feat[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}   
    $pattern = "/ feat /i"; 
    if(preg_match($pattern, $songName, $matches)){
        $songName = stristr($songName,"feat",true);
    } 
    $pattern = "/\([^\)]*\bft\.\b[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/（[^\)]*\bft\.\b[^\(]*\)/i"; 
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    } 
    $pattern = "/\([^\)]*ft\.[^\(\)]*/i";
    if(preg_match($pattern, $songName, $matches)){
       $songName = str_replace($matches[0], '',  $songName); 
    }		
			$pattern = "/\[[^\]]*\bft\.\b[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/[[^\]]*ft\.[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*ft\.[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
    $pattern = "/ft\./i"; 
    if(preg_match($pattern, $songName, $matches)){
        $songName = stristr($songName,"ft.",true);
    }
	$pattern = "/\s{2,}/i"; 
	if(preg_match($pattern, $songName, $matches)){
	   $songName = str_replace($matches[0], ' ',  $songName); 
	}
			
			
			$pattern = "/\([^\)]*edit[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			$pattern = "/（[^\)]*edit[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			} 
			$pattern = "/\([^\)]*edit[^\(\)]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			$pattern = "/\[[^\]]*edit[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/（[^\)]*edit[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*edit[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
			
			$pattern = "/\[[^\]]*track[^\[]*\]/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/（[^\)]*track[^\(]*\)/i"; 
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}			
			$pattern = "/\[[^\]]*track[^\[\]]*/i";
			if(preg_match($pattern, $songName, $matches)){
			   $songName = str_replace($matches[0], '',  $songName); 
			}
	
	$songName = trim($songName," ");
	
	return $songName;
}

function removeDoubleQuote($query)
{
	return str_replace('&quot;','', $query);
}

function removeHash($query)
{
	return str_replace('#','', $query);
}

function fixSingleQuote($query)
{
	return str_replace("'","%27",$query);
}

function fixAmpersand($query)
{
	return str_replace("&","%26",$query);
}

function fixPercentage($query)
{
	return str_replace("%","%25",$query);
}

function removeCnJapan($query)
{
	$query = preg_replace("/[\p{Han}\p{Hiragana}\p{Katakana}]/u", "", $query);
	return $query;
}

function hasCnJapan($query)
{
	return preg_match("/[\p{Han}+\p{Hiragana}+\p{Katakana}]/u", $query);
}
function checkIrrelevent($query)
{
	if(hasCnJapan($query))
		$str=$query;
	else
		$str = strtoupper($query);
	if($str == "VARIOUS ARTISTS"||$str == "群星" || $str == "ORIGINAL SOUNDTRACK" || $str == "原声大碟" || $str == "Various Artists" || $str == "Various Artists")
	{
		return true;
	}
	else
	{
		return false;
	}
		
}

function albumNameTrimmer($sname,$query)
{
	if(checkIrrelevent($query))
	{
		$query = '';
	}
	else
	{
		if((hasCnJapan($query)) &&(!hasCnJapan($sname)))
		{
			$query = removeCnJapan($query);
			if (!preg_match("/[a-zA-Z]/u", $query))
			{
				$query = str_replace("-",' ',$query);
				$query = '';
			}
		}
		$query = fixPercentage($query);
		$query = removeDoubleQuote($query);
		$query = fixSingleQuote($query);		
		$query = fixAmpersand($query);
		$query = removeHash($query);
	}
	return $query;
}
?>