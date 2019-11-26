<?php

namespace Makao\Collection;


use Makao\Card;
use Makao\Exception\CardNotFoundException;

class CardCollection implements \Countable, \Iterator
{
    const FIRST_CARD_INDEX = 0;

    private $cards = [];
    private $position = self::FIRST_CARD_INDEX;


    /**
     * @inheritDoc
     */
    public function count() : int
    {
        return count($this->cards);
    }

    public function add($card) : self
    {
        $this->cards[] = $card;

        return $this;
    }

    public function pickCard() : Card
    {
        if (empty($this->cards)) {
            throw new CardNotFoundException('You can not pick card from empty CardCollection!');
        }
    }

    public function valid() : bool
    {
        return isset($this->cards[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function current() : ?Card
    {
        return $this->cards[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function next() : void
    {
        ++$this->position;
    }

    /**
     * @inheritDoc
     */
    public function key() : int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function rewind() : void
    {
        $this->position = self::FIRST_CARD_INDEX;
    }
}
