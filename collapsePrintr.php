<?php
	function collapsePrintr($input)
	{
		$lines = preg_split('#\r?\n#', trim($input));

		$last_level = 0;
		$dump_level=0;
		$fullout = false;
		echo "<div style='font-family: arial; font-size:13px;'><a href='#' onclick='showall()'>Show All</a> | <a href='#' onclick='hideall()'>Hide All</a></div><p/>";
		echo "	<div style='font-family: Courier; font-size:13px;'>";
		foreach($lines as $k => $line)
		{
			if((trim($line) == "") && !$fullout)
				continue;



			// get the tab count
			$tab_cnt = 0;
			$offset = 0;
			$test;
			while(($pos = strpos($line, "    ", $offset)) !== false)
			{
				$tab_cnt ++;
				$offset = $pos + 4;
			}

			// tab_cnt is now the "level" we are at

			if(!$fullout)
			{

				if($dump_level != 0 )
				{
					if(( $tab_cnt > $dump_level) )
						continue; // dump it
					else
					{ // we are back down to the original dump level, we are done dumping
					 	$dump_level = 0;
					}

				}


				//	get rid of nodes we never want.
				if(strpos($line, "=> Common_DB Object") !== false)
				{	// dump this node
					$dump_level= $tab_cnt;
					continue;
				}

				
				$lines[$k] = str_replace(":", "&nbsp;:&nbsp;", $lines[$k]);


				if(trim($line) == "(")
				{ // start a new node content
					echo "		<div id='node_content__" . ($k-1 ) . "' >\n";

				}


				if(trim($lines[$k+1]) == "(")
					echo "			<span id='node_head__" .  ($k) . "' style='cursor:pointer;color:blue;'>" . str_pad($k, 4, '0', STR_PAD_LEFT) . " | " . str_pad($tab_cnt, 2, '0', STR_PAD_LEFT) . " | " .  str_replace("   ", "&nbsp;&nbsp;", $lines[$k]) . "</span><br>";
				else
				 	echo  str_pad($k, 4, '0', STR_PAD_LEFT) . " | " . str_pad($tab_cnt, 2, '0', STR_PAD_LEFT) . " | " .  str_replace("   ", "&nbsp;&nbsp;", $lines[$k])	  . "<br>";

				if(trim($line) == ")")
				{ // end node content
					echo "		</div>\n";
				}
        
				$last_level = $tab_cnt;
			}

		}

		echo "</div>";
		
		?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script type='text/javascript'>
			$(document).on("click", "span[id^=node_head__]", function(event) {

				var a = $(this).attr('id').split("__");
				var node = a[1];
				$('#node_content__' + node).toggle();

			});
			$('div[id^=node_content__]').hide();
			
			function showall() {
				$('div[id^=node_content__]').show();
			}
			
			function hideall() {
				$('div[id^=node_content__]').hide();
			}
			
		</script>
		<?php


	}
	
// usage	
collapsePrintr(print_r($myObject,true));

?>
