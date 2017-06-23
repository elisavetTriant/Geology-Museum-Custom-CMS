<?php 
class MenuHelper extends Helper
{
    var $helpers = array('Html');
    
   function generate_menu($links = array(), $htmlAttributes = array(), $type = 'ul')
    {      
        $this->tags['ul'] = '<ul%s>%s</ul>';
        $this->tags['ol'] = '<ol%s>%s</ol>';
        $this->tags['li'] = '<li%s>%s</li>';
        $out = array();        
        
		$i = 0;
		
		foreach ($links as $link)
        {
          $title = $link['title'];
		  $url = $link['url'];
		  $class = $link['class'];
		  $frontpage_flag = $link['frontpage'];
			
			if ($i == 0)
				$class = 'class = "first"';
			else if ($i == count($links)-1)
				$class = 'class = "last"';
			
			$id = '';
			
			//debug('This here (haystack)'.$this->here);
			//debug('$this->url($url) (needle):'. $this->url($url));
			//debug('Result:'.strrpos($this->here, $this->url($url)));
			if( strrpos($this->here, $this->url($url)) === false  )
				$id = '';
			else if (!$frontpage_flag) 
				$id = ' id = "current" ';
			else if ($this->webroot == $this->here)
				$id = ' id = "current" ';
				
			$liStyling  = $id.' '.$class;
			
			
			$out[] = sprintf($this->tags['li'], $liStyling, $this->Html->link($title, $url, array(), false, false));	
			
			$i++;
			$class = '';
			
        }
        $tmp = join("\n", $out);
        return $this->output(sprintf($this->tags[$type],$this->_parseAttributes($htmlAttributes), $tmp));
    }
   
   
       function generate_simple_menu($links = array(),$htmlAttributes = array(),$type = 'ul')
    {      
        $this->tags['ul'] = '<ul%s>%s</ul>';
        $this->tags['ol'] = '<ol%s>%s</ol>';
        $this->tags['li'] = '<li%s>%s</li>';
        $out = array();        
        
		foreach ($links as  $link)
        {
          
		  $title = $link['title'];
		  $url = $link['url'];
		  $class = $link['class'];
		  
		  $renderClass = '';
		   
		  if($this->params['controller'] ==  $url['controller'] )
		  	$renderClass = ' active';
			
		 	 $renderClass =  $renderClass.' '.$link['class']; 
		  
		  
				$out[] = sprintf($this->tags['li'],' class= "'.$renderClass.'"' ,$this->Html->link($title,  $url));
	
				
        }
        $tmp = join("\n", $out);
        return $this->output(sprintf($this->tags[$type],$this->Html->_parseAttributes($htmlAttributes), $tmp));
    }
   
   
   
    function generate_nested_menu($links = array(),$htmlAttributes = array(),$type = 'ul')
    {      
        $this->tags['ul'] = '<ul%s>%s</ul>';
        $this->tags['ol'] = '<ol%s>%s</ol>';
        $this->tags['li'] = '<li%s>%s</li>';
        $out = array();        
        
		foreach ($links as $title => $link)
        {
           
		   $current_sub = $title.'_sub';
		   $submenu = '';
		   if (isset($links[$current_sub]) && is_array($links[$current_sub])){
		   
		   	
		   		$submenu = $this->generate_menu($links[$current_sub]);
		   
		   }
		   
		   if (!strpos($title, '_sub')){
				if( ($this->params['url']['url'] == substr($link, 1)) || ($this->params['url']['url'] == substr($link, 1).'/'))
				{
					$out[] = sprintf($this->tags['li'],' class="active"',$this->Html->link($title, $link).$submenu);
				}
				else
				{
					$out[] = sprintf($this->tags['li'],'',$this->Html->link($title, $link).$submenu );
				}
			}
			
			$submenu = '';
        }
        $tmp = join("\n", $out);
        return $this->output(sprintf($this->tags[$type],$this->Html->_parseAttributes($htmlAttributes), $tmp));
    }
}
?> 