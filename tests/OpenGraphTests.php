<?php

class OpenGraphTest extends PHPUnit_Framework_TestCase
{
    
    protected function getInstance()
    {
        return new ChrisKonnertz\OpenGraph\OpenGraph();
    }

    public function testBasicTags()
    {
        $og = $this->getInstance();

        $og->title('Apple Cookie')
            ->type('article')
            ->image('http://example.org/apple.jpg')
            ->description('Welcome to the best apple cookie recipe never created.')
            ->url('http://example.org/');
    }

}