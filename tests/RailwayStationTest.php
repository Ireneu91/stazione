<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

final class RailwayStationTest extends TestCase
{
    public function test_constructor_validates_tracks_and_waiting_passengers(): void
    {
        $this->markTestIncomplete('Testa che tracks >= 1 e waitingPassengers >= 0; devono lanciare InvalidArgumentException in caso contrario.');
    }

    public function test_assign_first_free_track_returns_first_free_track_and_null_when_full(): void
    {
        $this->markTestIncomplete('Testa che i binari vengano assegnati in ordine (1..N) e che quando sono tutti occupati ritorni null.');
    }

    public function test_assign_first_free_track_is_idempotent_for_same_train(): void
    {
        $this->markTestIncomplete('Testa che chiamando assignFirstFreeTrack due volte per lo stesso trainId venga ritornato lo stesso binario già assegnato.');
    }

    public function test_release_track_frees_the_track_for_new_trains(): void
    {
        $this->markTestIncomplete('Testa che releaseTrack() liberi il binario e permetta ad un nuovo treno di ottenerlo.');
    }

    public function test_board_passengers_boards_between_0_and_capacity_and_decreases_waiting(): void
    {
        $this->markTestIncomplete('Testa boardPassengers(): usa FixedRandomizer per forzare quanti salgono; verifica decremento waitingPassengers e incremento passeggeri sul treno senza superare capienza.');
    }

    public function test_board_passengers_returns_zero_when_no_waiting_or_no_capacity(): void
    {
        $this->markTestIncomplete('Testa che boardPassengers() ritorni 0 quando waitingPassengers=0 o quando il treno è già pieno.');
    }
}
