<?php


namespace Tests\Makao;

use Makao\Exception\TooManyPlayersAtTheTableException;
use Makao\Player;
use Makao\Table;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{
    /**
     * @var Table
     */
    private $tableUnderTest;

    public function setUp()
    {
        $this->tableUnderTest = new Table();
    }


    public function testShouldCreateEmptyTable() {
        // Given
        $expected = 0;

        // When
        $actual = $this->tableUnderTest->countPlayers();

        // Then
        $this->assertSame($expected, $actual);

    }

    public function testShouldAddOnePlayerToTable() {
        // Given
        $excepted = 1;
        $player = new Player();

        // When
        $this->tableUnderTest->addPlayer($player);
        $actual = $this->tableUnderTest->countPlayers();

        // Then
        $this->assertSame($excepted, $actual);
    }

    public function testShouldReturnCountWhenIAddManyPlayers() {
        // Given
        $excepted = 2;

        // When
        $this->tableUnderTest->addPlayer(new Player());
        $this->tableUnderTest->addPlayer(new Player());
        $actual = $this->tableUnderTest->countPlayers();

        // Then
        $this->assertSame($excepted, $actual);
    }

    public function testShouldThrowTooManyPlayersAtTheTableExceptionWhenITryAddMoreThanFourPlayers(){
        // Expect
        $this->expectException(TooManyPlayersAtTheTableException::class);
        $this->expectExceptionMessage('Max capacity is 4 players');

        // When
        $this->tableUnderTest->addPlayer(new Player());
        $this->tableUnderTest->addPlayer(new Player());
        $this->tableUnderTest->addPlayer(new Player());
        $this->tableUnderTest->addPlayer(new Player());
        $this->tableUnderTest->addPlayer(new Player());

    }

}
