<?php

declare(strict_types=1);

namespace Tests;

use App\RailwayStation;
use App\Train;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

final class RailwayStationTest extends TestCase
{
    public function test_constructor_validates_tracks_and_waiting_passengers(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RailwayStation(0, -1);

        // $this->markTestIncomplete('Testa che tracks >= 1 e waitingPassengers >= 0; devono lanciare InvalidArgumentException in caso contrario.');
    }

    public function test_assign_first_free_track_returns_first_free_track_and_null_when_full(): void
    {
        $numero_binari = 2;
        $stazione = new RailwayStation(tracksCount: $numero_binari, waitingPassengers: 220);
        for($i = 1; $i <= $numero_binari+1; $i++){
            $treno =  new Train('T'.$i, capacity: 180, passengers: 140);
            $binario = $stazione->assignFirstFreeTrack($treno->getId());
            if($i == $numero_binari+1){
                self::assertEquals(null, $binario);
            } else {
                self::assertEquals($i, $binario);
            }
        }

        // $this->markTestIncomplete('Testa che i binari vengano assegnati in ordine (1..N) e che quando sono tutti occupati ritorni null.');
    }

    public function test_assign_first_free_track_is_idempotent_for_same_train(): void
    {
        $stazione = new RailwayStation(tracksCount: 2, waitingPassengers: 220);
        $treno =  new Train('MIOTRENO', capacity: 180, passengers: 140);
        $binario_assegnato1 = $stazione->assignFirstFreeTrack($treno->getId());
        $binario_assegnato2 = $stazione->assignFirstFreeTrack($treno->getId());

        self::assertSame($binario_assegnato1, $binario_assegnato2);

        // $this->markTestIncomplete('Testa che chiamando assignFirstFreeTrack due volte per lo stesso trainId venga ritornato lo stesso binario già assegnato.');
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
