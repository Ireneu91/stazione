<?php

declare(strict_types=1);

namespace Tests;

use App\Train;
use App\RailwayStation;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use TypeError;

use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertNotEmpty;

final class TrainTest extends TestCase
{
    public function test_constructor_validates_id_capacity_and_passengers(): void
    {
        $id = 'T1';
        $capacity = 180;
        $passengers = 140;
        $treno = new Train($id, $capacity, $passengers);

        $this::assertNotEmpty($treno->getId());
        $this::assertEquals($capacity, $treno->getCapacity());
        $this::assertEquals($passengers, $treno->getPassengers());

        $id = null;
        $this->expectException(TypeError::class);
        $treno = new Train($id, $capacity, $passengers);

        $id = 'T1';
        $capacity = 0;
        $treno = new Train($id, $capacity, $passengers);
        $this->expectException(InvalidArgumentException::class);

        $id = 'T1';
        $passengers = -1;
        $treno = new Train($id, $capacity, $passengers);
        $this->expectException(InvalidArgumentException::class);

        $id = 'T1';
        $capacity = 1;
        $passengers = 2;
        $treno = new Train($id, $capacity, $passengers);
        $this->expectException(InvalidArgumentException::class);

        // $this->markTestIncomplete('Testa validazioni: id non vuoto, maxCapacity >= 1, passengers >= 0 e <= maxCapacity.');
    }

    public function test_request_track_sets_current_track_when_assigned(): void
    {
        $id = 'T1';
        $capacity = 180;
        $passengers = 140;
        $treno = new Train($id, $capacity, $passengers);
        $stazione = new RailwayStation(2);

        $binario_assegnato = $treno->requestTrack($stazione);
        $this->assertEquals($binario_assegnato, $treno->getAssignedTrack());

        // $this->markTestIncomplete('Testa che requestTrack() ritorni il binario assegnato e imposti getAssignedTrack() coerentemente.');
    }

    public function test_request_track_sets_current_track_to_null_when_station_is_full(): void
    {
        $treno1 = new Train('T1', $capacity = 180, $passengers = 140);
        $treno2 = new Train('T2', $capacity = 120, $passengers = 100);
        $treno3 = new Train('T3', $capacity = 120, $passengers = 100);
        $stazione = new RailwayStation(2);
        $treno1->requestTrack($stazione);
        $treno2->requestTrack($stazione);
        $treno3->requestTrack($stazione);

        $this->assertNull($treno3->requestTrack($stazione));
        $this->assertNull($treno3->getAssignedTrack($stazione));

        // $this->markTestIncomplete('Testa che se la stazione non ha binari liberi, requestTrack() ritorni null e getAssignedTrack() sia null.');
    }

    public function test_disembark_decreases_passengers_and_adds_random_waiting_passengers(): void
    {
        $treno1 = new Train('T1', $capacity = 180, $passengers = 140);

        $this->markTestIncomplete('Testa dropOffPassengers(): i passeggeri a bordo diminuiscono; una parte (controllata con FixedRandomizer) viene aggiunta ai waitingPassengers della stazione; il metodo ritorna quel numero.');
    }

    public function test_passenger_never_passengers_more_than_on_board(): void
    {
        $this->markTestIncomplete('Testa che se chiedi di far scendere più passeggeri di quelli presenti, scendano solo quelli disponibili (passengers non va sotto zero).');
    }

    public function test_board_increases_passengers_and_throws_if_exceeds_capacity(): void
    {
        $this->markTestIncomplete('Testa board(): aumenta passengers; se supera maxCapacity lancia RangeException.');
    }

    public function test_depart_releases_track_and_resets_current_track(): void
    {
        $this->markTestIncomplete('Testa che depart() liberi il binario in stazione e imposti getAssignedTrack() a null.');
    }
}
