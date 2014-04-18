<?php

class OpenGraphTests extends \Orchestra\Testbench\TestCase {

    protected function getPackageAliases()
    {
        return array(
            'OpenGraph' => 'ChrisKonnertz\OpenGraph\OpenGraph'
        );
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function testBasicTags()
    {
        $og = new OpenGraph();

        $og->title('Apple Cookie')
            ->type('article')
            ->image('http://example.org/apple.jpg')
            ->description('Welcome to the best apple cookie recipe never created.')
            ->url();
    }

}