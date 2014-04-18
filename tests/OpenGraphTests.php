<?php

class OpenGraphTest extends \PHPUnit_Framework_TestCase
{
    protected function getOpenGraph()
    {
        return $this->getMockBuilder('ChrisKonnertz\OpenGraph\OpenGraph')
                    ->getMock();
    }

    public function testBasicTags()
    {
        $og = $this->getOpenGraph();

        $og->title('Apple Cookie')
            ->type('article')
            ->image('http://example.org/apple.jpg')
            ->description('Welcome to the best apple cookie recipe never created.')
            ->url();
    }

}