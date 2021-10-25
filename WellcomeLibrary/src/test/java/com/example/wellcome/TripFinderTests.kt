package com.example.wellcome

import com.example.wellcome.models.*
import utils.DateUtils
import org.junit.Test
import org.junit.Assert.*
import kotlin.collections.ArrayList

class TripFinderTests {
    private val tripFinder = TripFinder()

    @Test
    fun findTripsTest(){
        val host : Host
            = Host("MyTitle","MyDescription", getHostAddress(), "0668319800", ArrayList(),
            getHostSlotsDate(), getHostRestriction(), getHostConfiguration())
        val trip : Trip =
            Trip(getTripSlotDate(), TripCity("France", "Soisy", "95230"), 1.0, -1,
                getTripHostConfiguration(), 2, false, true, false)

        assertTrue(tripFinder.isHostMatching(trip, host))
    }

    @Test
    fun findTripsInvalidTravelersTest(){
        val host : Host
                = Host("MyTitle","MyDescription", getHostAddress(), "0668319800", ArrayList(),
            getHostSlotsDate(), getHostRestriction(), getHostConfiguration())
        val trip : Trip =
            Trip(getTripSlotDate(), TripCity("France", "Soisy", "95230"), 1.0, -1,
                getTripHostConfiguration(), 3, false, true, false)

        assertFalse(tripFinder.isHostMatching(trip, host))
    }

    @Test
    fun findTripsInvalidDogsTest(){
        val host : Host
                = Host("MyTitle","MyDescription", getHostAddress(), "0668319800", ArrayList(),
            getHostSlotsDate(), getHostRestriction(), getHostConfiguration())
        val trip : Trip =
            Trip(getTripSlotDate(), TripCity("France", "Soisy", "95230"), 1.0, -1,
                getTripHostConfiguration(), 2, true, true, false)

        assertFalse(tripFinder.isHostMatching(trip, host))
    }

    @Test
    fun findTripsInvalidCityTest(){
        val host : Host
                = Host("MyTitle","MyDescription", getHostAddress(), "0668319800", ArrayList(),
            getHostSlotsDate(), getHostRestriction(), getHostConfiguration())
        val trip : Trip =
            Trip(getTripSlotDate(), TripCity("Japan", "Tokyo", "163-8001"), 1.0, -1,
                getTripHostConfiguration(), 2, false, true, false)

        assertFalse(tripFinder.isHostMatching(trip, host))
    }

    @Test
    fun findTripsInvalidChildsTest(){
        val host : Host
                = Host("MyTitle","MyDescription", getHostAddress(), "0668319800", ArrayList(),
            getHostSlotsDate(), getHostRestriction(), getHostConfiguration())
        val trip : Trip =
            Trip(getTripSlotDate(), TripCity("France", "Soisy", "95230"), 1.0, -1,
                getTripHostConfiguration(), 2, false, true, true)

        assertFalse(tripFinder.isHostMatching(trip, host))
    }

    @Test
    fun findTripsValidBabiesTest(){
        val host : Host
                = Host("MyTitle","MyDescription", getHostAddress(), "0668319800", ArrayList(),
            getHostSlotsDate(), getHostRestriction(), getHostConfiguration())
        val trip : Trip =
            Trip(getTripSlotDate(), TripCity("France", "Soisy", "95230"), 1.0, -1,
                getTripHostConfiguration(), 2, false, false, false)

        assertTrue(tripFinder.isHostMatching(trip, host))
    }

    private fun getHostAddress() : Address
        = Address(country = Country(
            addressLine = "France",
            administrativeArea = AdministrativeArea(
                addressLine = "Val d'oise", locality = Locality(
                    addressLine = "Soisy",
                    thoroughfare = Thoroughfare(addressLine = "9 rue du puits grenet"),
                    postalCode = PostalCode(addressLine = "95230")
                )
            )
        ))

    private fun getHostSlotsDate() : List<SlotDate>
        = listOf(SlotDate(DateUtils.asLocalDate("12/12/2018" ), DateUtils.asLocalDate("15/12/2018")),
            SlotDate(DateUtils.asLocalDate("16/12/2018" ), DateUtils.asLocalDate("18/12/2018"))
            )

    private fun getTripSlotDate() : SlotDate
            = SlotDate(DateUtils.asLocalDate("12/12/2018" ), DateUtils.asLocalDate("15/12/2018"))

    private fun getHostRestriction() : HostRestrictions
        = HostRestrictions(2, true, false, false)

    private fun getHostConfiguration() : HostConfiguration
            = HostConfiguration(2, 1, 1, ArrayList())

    private fun getTripHostConfiguration() : HostConfiguration
            = HostConfiguration(2, 1, 1, ArrayList())
}