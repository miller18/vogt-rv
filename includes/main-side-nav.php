<ul class="side-nav">

	<?php if($dealership == 'South' || $dealership == 'Both' || $dealership == 'Main' ) { ?>
	
	<li class="nav-title"><a href="vogt-motorhomes.php">Motorhome Center</a></li>
	
	<?php if($dealership == 'South') { ?>
	
	<li class="nav-address">
		<p class="text-centered">
			5624 Airport Freeway<br />
			Fort Worth, TX 76117<br />
			817.831.4222
		</p>
	</li>
	
	<?php } ?>
	<li class="nav-button"><a href="pre-owned-rv-listing.php?location=South&unit_condition=Pre Owned" class="side-nav-button-orange">Pre-Owned Motorhomes</a></li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#tiffin-drawer">Allegro/Tiffin</a></li>
	<li class="drawer" id="tiffin-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?make=Tiffin&unit_condition=New">All Tiffin Motorhomes</a></li>
			<li><a href="rv-inventory-listing.php?model=Allegro&unit_condition=New">Allegro</a></li>
			<li><a href="rv-inventory-listing.php?model=Allegro Breeze&unit_condition=New">Allegro Breeze</a></li>
			<li><a href="rv-inventory-listing.php?model=Allegro Red&unit_condition=New">Allegro Red</a></li>
			<li><a href="rv-inventory-listing.php?model=Phaeton&unit_condition=New">Phaeton</a></li>
			<li><a href="rv-inventory-listing.php?model=Allegro Bus&unit_condition=New">Allegro Bus</a></li>
			<li><a href="rv-inventory-listing.php?model=Zephyr&unit_condition=New">Zephyr</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="rv-inventory-listing.php?location=South&make=Airstream&unit_condition=New" class="side-nav-button">Airstream</a></li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#jayco-mh-drawer">Jayco</a></li>
	<li class="drawer" id="jayco-mh-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?location=South&make=Jayco&unit_condition=New">All Jayco Motorhomes</a></li>
			<li><a href="rv-inventory-listing.php?model=Redhawk&unit_condition=New">Redhawk</a></li>
			<li><a href="rv-inventory-listing.php?model=Greyhawk&unit_condition=New">Greyhawk</a></li>
			<li><a href="rv-inventory-listing.php?model=Melbourne&unit_condition=New">Melbourne</a></li>
			<li><a href="rv-inventory-listing.php?model=Seneca&unit_condition=New">Seneca</a></li>
			<li><a href="rv-inventory-listing.php?model=Precept&unit_condition=New">Precept</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#leisure-travel-drawer">Leisure Travel</a></li>
	<li class="drawer" id="leisure-travel-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?make=Leisure Travel&unit_condition=New">All Leisure Travel Motorhomes</a></li>
			<li><a href="rv-inventory-listing.php?model=Free Spirit&unit_condition=New">Free Spirit</a></li>
			<li><a href="rv-inventory-listing.php?model=Serenity&unit_condition=New">Serenity</a></li>
			<li><a href="rv-inventory-listing.php?model=Unity&unit_condition=New">Unity</a></li>
		</ul>
	</li>	
	<li class="nav-button"><a href="rv-inventory-listing.php?location=South&make=Renegade&unit_condition=New" class="side-nav-button">Renegade</a></li>
	<li class="nav-button"><a href="rv-inventory-listing.php?location=South&make=Midwest Automotive&unit_condition=New" class="side-nav-button">Mid-West Auto</a></li>	
	
	
	<?php } ?>
	<?php if($dealership == 'North' || $dealership == 'Both' ||$dealership == 'Main') { ?> 
	
	<li class="nav-title"><a href="vogt-family-fun-center.php">Family Fun Center</a></li>
	
	<?php if($dealership == 'North') { ?>
	
	<li class="nav-address">
		<p class="text-centered">
			5301 Airport Freeway<br />
			Fort Worth, TX 76117<br />
			817.831.1800
		</p>
	</li>
	
	<?php } ?>
	<li class="nav-button"><a href="pre-owned-rv-listing.php?location=North&unit_condition=Pre Owned" class="side-nav-button-orange">Pre-Owned Towables</a></li>
	<li class="nav-button"><a href="#" class="side-nav-button-green toggle" gumby-trigger="#specials-tt-drawer">Specials</a></li>
	<li class="drawer" id="specials-tt-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?specials=2">Managers Specials</a></li>
		</ul>
	</li>
	
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#airstream-tt-drawer">Airstream</a></li>
	<li class="drawer" id="airstream-tt-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?make=Airstream&location=North&unit_condition=New">All Airstream Trailers</a></li>
			<li><a href="rv-inventory-listing.php?model=Sport&unit_condition=New">Sport</a></li>
			<li><a href="rv-inventory-listing.php?model=Flying Cloud&unit_condition=New">Flying Cloud</a></li>
			<li><a href="rv-inventory-listing.php?model=International Signature&unit_condition=New">Signature</a></li>
			<li><a href="rv-inventory-listing.php?model=International Sterling&unit_condition=New">Sterling</a></li>
			<li><a href="rv-inventory-listing.php?model=International Serenity&unit_condition=New">Serenity</a></li>
			<li><a href="rv-inventory-listing.php?model=Eddie Bauer&unit_condition=New">Eddie Bauer</a></li>
			<li><a href="rv-inventory-listing.php?model=Classic&unit_condition=New">Classic</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#crossroads-drawer">Crossroads</a></li>
	<li class="drawer" id="crossroads-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?make=Crossroads&unit_condition=New">All Crossroads Trailers</a></li>
			<li><a href="rv-inventory-listing.php?model=Sunset Trail Lite&unit_condition=New">Sunset Trail Lite</a></li>
			<li><a href="rv-inventory-listing.php?model=Sunset Trail Reserve&unit_condition=New">Sunset Trail Reserve</a></li>
			<li><a href="rv-inventory-listing.php?model=Cruiser&unit_condition=New">Cruiser</a></li>
			<li><a href="rv-inventory-listing.php?model=Cruiser Aire&unit_condition=New">Cruiser Aire</a></li>
			<li><a href="rv-inventory-listing.php?model=Cruiser Patriot&unit_condition=New">Cruiser Patriot</a></li>
			<li><a href="rv-inventory-listing.php?model=Rushmore&unit_condition=New">Rushmore</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#cruiser-rv-drawer">Cruiser RV</a></li>
	<li class="drawer" id="cruiser-rv-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?make=Cruiser RV&unit_condition=New">All Cruiser Trailers</a></li>
			<li><a href="rv-inventory-listing.php?model=Shadow Cruiser&unit_condition=New">Shadow Cruiser</a></li>
			<li><a href="rv-inventory-listing.php?model=Viewfinder&unit_condition=New">Viewfinder</a></li>
			<li><a href="rv-inventory-listing.php?model=Radiance&unit_condition=New">Radiance</a></li>
			<li><a href="rv-inventory-listing.php?model=Fun Finder&unit_condition=New">Fun Finder</a></li>
			<li><a href="rv-inventory-listing.php?model=Enterra&unit_condition=New">Enterra</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#dutchmen-drawer">Dutchmen</a></li>
	<li class="drawer" id="dutchmen-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?make=Dutchmen&unit_condition=New">All Dutchmen Trailers</a></li>
			<li><a href="rv-inventory-listing.php?model=Dutchmen&unit_condition=New">Dutchmen</a></li>
			<li><a href="rv-inventory-listing.php?model=Aerolite&unit_condition=New">Aerolite</a></li>
			<li><a href="rv-inventory-listing.php?model=Infinity&unit_condition=New">Infinity</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#jayco-tt-drawer">Jayco</a></li>
	<li class="drawer" id="jayco-tt-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?unit_condition=New&make=Jayco&location=North">All Jayco Trailers</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Jay Series">Jay Series</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Jay Flight Swift SLX">Jay Flight Swift SLX</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Jay Flight Swift">Jay Flight Swift</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Jay Flight">Jay Flight</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Jay Feather SLX">Jay Feather SLX</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Jay Feather">Jay Feather</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=White Hawk">White Hawk</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Eagle">Eagle</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Eagle Premier">Eagle Premier</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Pinnacle">Pinnacle</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Octane">Octane</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Seismic">Seismic</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="rv-inventory-listing.php?unit_condition=New&make=Livin Lite Corp" class="side-nav-button">Livin Lite</a></li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#shasta-drawer">Shasta</a></li>
	<li class="drawer" id="shasta-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?unit_condition=New&make=Shasta">All Shasta Trailers</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Oasis">Oasis</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Revere">Revere</a></li>
		</ul>
	</li>
	<li class="nav-button"><a href="#" class="side-nav-button toggle" gumby-trigger="#sunnybrook-drawer">Sunnybrook</a></li>
	<li class="drawer" id="sunnybrook-drawer">
		<ul class="nav-drawer">
			<li><a href="rv-inventory-listing.php?unit_condition=New&make=Sunnybrook">All Sunnybrook Trailers</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Sunset Creek">Sunset Creek</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Remington">Remington</a></li>
			<li><a href="rv-inventory-listing.php?unit_condition=New&model=Raven">Raven</a></li>
		</ul>
	</li>
	
	
	<?php } ?>
	
</ul>