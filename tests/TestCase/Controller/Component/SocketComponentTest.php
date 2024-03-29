<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\SocketComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\SocketComponent Test Case
 */
class SocketComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\SocketComponent
     */
    public $Socket;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Socket = new SocketComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Socket);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
