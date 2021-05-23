<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

new NativeTplHeir(); // just for autoload

final class NativeTplHeirTest extends TestCase{
  
  private function formatHtml($html){
    return preg_replace('/\s+/', ' ', trim($html));
  }
  
  public function testInheritance(){
    
    ob_start();
    
    include __DIR__.'/views/index.php';
    
    $actual= ob_get_clean();
        
    $expected= file_get_contents(__DIR__.'/views/index.html');

    $this->assertEquals($this->formatHtml($expected), $this->formatHtml($actual));
    
  }
  
}

