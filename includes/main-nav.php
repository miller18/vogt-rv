<!-- container to normalize fixed navigation behavior when scrolling -->
	<div class="navcontain">
		<div class="metro navbar" gumby-fixed="top" id="nav3">
			<div class="row">
				<a class="toggle" gumby-trigger="#nav3 &gt; .row &gt; ul" href="#"><i class="icon-menu"></i></a>
				<h4 class="three columns logo">
					<a href="index.php">
						<!--
						<img src="bower_components/gumby/img/gumby_mainlogo.png" gumby-retina=""-->
						Vogt RV Centers
					</a>
				</h4>
				
				<!-- Phone Navigation -->
				<ul class="nine columns show-for-small">
					<li><a href="vogt-family-fun-center.php">Vogt Family Fun Center</a></li>
					<li><a href="vogt-motorhomes.php">Vogt Motorhomes</a></li>
					<li><a href="rv-service.php">Service</a></li>
					<li><a href="rv-parts.php">Parts</a></li>
					<li><a href="rv-financing.php">Finance</a></li>
					<li><a href="consignment.php">Consignment</a></li>
				</ul>
				
				<!-- Non Phone Navigation -->
				
				<ul class="nine columns hide-for-small">

					<li>
						<a href="#">Locations</a>
						<div class="dropdown">
							<ul>
								<li><a href="vogt-family-fun-center.php">Vogt Family Fun Center</a></li>
								<li><a href="vogt-motorhomes.php">Vogt Motorhomes</a></li>
							</ul>
						</div>
					</li>
				
					<?php if($dealership == 'Both') { ?>
					
					<li>
						<a href="#" class="toggle" gumby-trigger="#trailer-drawer">Towable RVs</a>
					</li>
					<li>
						<a href="#" class="toggle" gumby-trigger="#motorized-drawer">Motorized RVs</a>
					</li>
					
					<?php } ?>
					
					
					<?php if($dealership == 'North' || $dealership == 'Main' ) { ?>
					
					<li>
						<a href="#">Towable RVs</a>
						<div class="dropdown">
							<ul>
								<li><a href="rv-inventory-listing.php?type=Travel Trailer">Travel Trailers</a></li>
								<li><a href="rv-inventory-listing.php?type=Fifth Wheel">Fifth Wheels</a></li>
								<li><a href="rv-inventory-listing.php?type=Tent Camper">Tent Campers</a></li>
								<li><a href="pre-owned-rv-listing.php?location=North&unit_condition=Pre Owned">Pre Owned</a></li>
							</ul>
						</div>
					</li>
					
					<?php } ?>
					
					<?php if ($dealership == 'South' || $dealership == 'Main') { ?>

					<li>
						<a href="#">Motorized RVs</a>
						<div class="dropdown">
							<ul>
								<li><a href="rv-inventory-listing.php?type=Class A">Gas Class A</a></li>
								<li><a href="rv-inventory-listing.php?type=Class B">Class B</a></li>
								<li><a href="rv-inventory-listing.php?type=Class C">Class C</a></li>
								<li><a href="rv-inventory-listing.php?type=Diesel Pusher">Diesel Pushers</a></li>
								<li><a href="pre-owned-rv-listing.php?location=South&unit_condition=Pre Owned">Pre Owned</a></li>
							</ul>
						</div>
					</li>
					
					<?php } ?>
					
					<li><a href="rv-service.php">Service</a></li>
					<li><a href="rv-parts.php">Parts</a></li>
					<li><a href="rv-financing.php">Finance</a></li>
					<li><a href="consignment.php">Consignment</a></li>
					
				</ul>
			</div>
			
			<div class=" color-secondary-orange full-width-shadow">
			    <div class="row navbar drawer" id="trailer-drawer">
			    	<ul>
				    	<li>
							<a href="#">Jayco Trailers</a>
							<div class="dropdown">
								<ul>
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
							</div>
				    	</li>
				    	<li>
				    		<a href="#">Crossroads</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="rv-inventory-listing.php?make=Crossroads RV&unit_condition=New">All Crossroads Trailers</a></li>
									<li><a href="rv-inventory-listing.php?model=Sunset Trail Lite&unit_condition=New">Sunset Trail Lite</a></li>
									<li><a href="rv-inventory-listing.php?model=Sunset Trail Reserve&unit_condition=New">Sunset Trail Reserve</a></li>
									<li><a href="rv-inventory-listing.php?model=Cruiser&unit_condition=New">Cruiser</a></li>
									<li><a href="rv-inventory-listing.php?model=Cruiser Aire&unit_condition=New">Cruiser Aire</a></li>
									<li><a href="rv-inventory-listing.php?model=Cruiser Patriot&unit_condition=New">Cruiser Patriot</a></li>
									<li><a href="rv-inventory-listing.php?model=Rushmore&unit_condition=New">Rushmore</a></li>
								</ul>
							</div>
				    	</li>
				    	<li>
				    		<a href="#">Cruiser RV</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="rv-inventory-listing.php?make=Cruiser RV&unit_condition=New">All Cruiser Trailers</a></li>
									<li><a href="rv-inventory-listing.php?model=Shadow Cruiser&unit_condition=New">Shadow Cruiser</a></li>
									<li><a href="rv-inventory-listing.php?model=Viewfinder&unit_condition=New">Viewfinder</a></li>
									<li><a href="rv-inventory-listing.php?model=Radiance&unit_condition=New">Radiance</a></li>
									<li><a href="rv-inventory-listing.php?model=Fun Finder&unit_condition=New">Fun Finder</a></li>
									<li><a href="rv-inventory-listing.php?model=Enterra&unit_condition=New">Enterra</a></li>
								</ul>
							</div>
				    	</li>
				    	<li>
				    		<a href="#">Dutchmen</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="rv-inventory-listing.php?make=Dutchmen&unit_condition=New">All Dutchmen Trailers</a></li>
									<li><a href="rv-inventory-listing.php?model=Dutchmen&unit_condition=New">Dutchmen</a></li>
									<li><a href="rv-inventory-listing.php?model=Aerolite&unit_condition=New">Aerolite</a></li>
									<li><a href="rv-inventory-listing.php?model=Infinity&unit_condition=New">Infinity</a></li>
								</ul>
							</div>
				    	</li>
				    	<li>
				    		<a href="#">Airstream Trailers</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="rv-inventory-listing.php?make=Airstream&location=North&unit_condition=New">All Airstream Trailers</a></li>
									<li><a href="rv-inventory-listing.php?model=Sport&unit_condition=New">Sport</a></li>
									<li><a href="rv-inventory-listing.php?model=Flying Cloud&unit_condition=New">Flying Cloud</a></li>
									<li><a href="rv-inventory-listing.php?model=International Signature&unit_condition=New">Signature</a></li>
									<li><a href="rv-inventory-listing.php?model=International Sterling&unit_condition=New">Sterling</a></li>
									<li><a href="rv-inventory-listing.php?model=International Serenity&unit_condition=New">Serenity</a></li>
									<li><a href="rv-inventory-listing.php?model=Eddie Bauer&unit_condition=New">Eddie Bauer</a></li>
									<li><a href="rv-inventory-listing.php?model=Classic&unit_condition=New">Classic</a></li>
								</ul>
							</div>
				    	</li>
				    	<li>
				    		<a href="#">Shasta</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="rv-inventory-listing.php?unit_condition=New&make=Shasta">All Shasta Trailers</a></li>
									<li><a href="rv-inventory-listing.php?unit_condition=New&model=Oasis">Oasis</a></li>
									<li><a href="rv-inventory-listing.php?unit_condition=New&model=Revere">Revere</a></li>
								</ul>
							</div>
				    	</li>
				    	<li>
				    		<a href="#">Sunnybrook</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="rv-inventory-listing.php?unit_condition=New&make=Sunnybrook">All Sunnybrook Trailers</a></li>
									<li><a href="rv-inventory-listing.php?unit_condition=New&model=Sunset Creek">Sunset Creek</a></li>
									<li><a href="rv-inventory-listing.php?unit_condition=New&model=Remington">Remington</a></li>
									<li><a href="rv-inventory-listing.php?unit_condition=New&model=Raven">Raven</a></li>
								</ul>
							</div>
				    	</li>
				    	<li><a href="rv-inventory-listing.php?unit_condition=New&make=Livin Lite Corp" >Livin Lite</a></li>
				    	<li>
				    		<a href="#">Pre-Owned</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="pre-owned-rv-listing.php?location=North&unit_condition=Pre Owned">All Pre-Owned Trailers</a></li>
									<li><a href="pre-owned-rv-listing.php?location=North&unit_condition=Pre Owned&type=Travel Trailer">Travel Trailers</a></li>
									<li><a href="pre-owned-rv-listing.php?location=North&unit_condition=Pre Owned&type=Fifth Wheel">Fifth Wheels</a></li>
									<li><a href="pre-owned-rv-listing.php?location=North&unit_condition=Pre Owned&type=Tent Camper">Tent Campers</a></li>
									<li><a href="pre-owned-rv-listing.php?location=North&unit_condition=Pre Owned&type=Toy Hauler">Toy Haulers</a></li>
								</ul>
							</div>
				    	</li>
			    	</ul>
				</div>
			</div>
		
			<div class=" color-secondary-yellow-lt full-width-shadow">
			    <div class="row navbar drawer" id="motorized-drawer">
			    	<ul>
				    	<li>
							<a href="#">Jayco Motorhomes</a>
							<div class="dropdown">
								<ul>
									<li><a href="rv-inventory-listing.php?location=South&make=Jayco&unit_condition=New">All Jayco Motorhomes</a></li>
									<li><a href="rv-inventory-listing.php?model=Redhawk&unit_condition=New">Redhawk</a></li>
									<li><a href="rv-inventory-listing.php?model=Greyhawk&unit_condition=New">Greyhawk</a></li>
									<li><a href="rv-inventory-listing.php?model=Melbourne&unit_condition=New">Melbourne</a></li>
									<li><a href="rv-inventory-listing.php?model=Seneca&unit_condition=New">Seneca</a></li>
									<li><a href="rv-inventory-listing.php?model=Precept&unit_condition=New">Precept</a></li>
								</ul>
							</div>
				    	</li>
				    	<li>
							<a href="#">Tiffin</a>
							<div class="dropdown">
								<ul>
									<li><a href="rv-inventory-listing.php?make=Tiffin&unit_condition=New">All Tiffin Motorhomes</a></li>
									<li><a href="rv-inventory-listing.php?model=Allegro&unit_condition=New">Allegro</a></li>
									<li><a href="rv-inventory-listing.php?model=Allegro Breeze&unit_condition=New">Allegro Breeze</a></li>
									<li><a href="rv-inventory-listing.php?model=Allegro Red&unit_condition=New">Allegro Red</a></li>
									<li><a href="rv-inventory-listing.php?model=Phaeton&unit_condition=New">Phaeton</a></li>
									<li><a href="rv-inventory-listing.php?model=Allegro Bus&unit_condition=New">Allegro Bus</a></li>
									<li><a href="rv-inventory-listing.php?model=Zephyr&unit_condition=New">Zephyr</a></li>
								</ul>
							</div>
				    	</li>
				    	<li><a href="rv-inventory-listing.php?location=South&make=Airstream&unit_condition=New">Airstream</a></li>
				    	<li>
							<a href="#">Leisure Travel</a>
							<div class="dropdown">
								<ul>
									<li><a href="rv-inventory-listing.php?make=Leisure Travel&unit_condition=New">All Leisure Travel Motorhomes</a></li>
									<li><a href="rv-inventory-listing.php?model=Free Spirit&unit_condition=New">Free Spirit</a></li>
									<li><a href="rv-inventory-listing.php?model=Serenity&unit_condition=New">Serenity</a></li>
									<li><a href="rv-inventory-listing.php?model=Unity&unit_condition=New">Unity</a></li>
								</ul>
							</div>
				    	</li>
				    	<li><a href="rv-inventory-listing.php?location=South&make=Renegade&unit_condition=New">Renegade</a></li>
				    	<li><a href="rv-inventory-listing.php?location=South&make=Midwest Automotive&unit_condition=New">Mid-West Auto</a></li>	
				    	<li>
				    		<a href="#">Pre-Owned</a>
							<div class="dropdown">
								<ul>
						    		<li><a href="pre-owned-rv-listing.php?location=South&unit_condition=Pre Owned">All Pre-Owned Motorhomes</a></li>
									<li><a href="pre-owned-rv-listing.php?location=South&unit_condition=Pre Owned&type=Diesel Pusher">Diesel Pushers</a></li>
									<li><a href="pre-owned-rv-listing.php?location=South&unit_condition=Pre Owned&type=Class A">Gas Class A</a></li>
									<li><a href="pre-owned-rv-listing.php?location=South&unit_condition=Pre Owned&type=Class B">Class B</a></li>
									<li><a href="pre-owned-rv-listing.php?location=South&unit_condition=Pre Owned&type=Class C">Class C</a></li>
								</ul>
							</div>
				    	</li>
			    	</ul>
			    </div>
			</div>
		
		</div>
		
	</div>
