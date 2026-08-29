<?php

return [

    'name' => 'MV Industrial & Mining Supplies Limited',
    'short_name' => 'MV Industrial',
    'tagline' => 'Bold · Passionate · Innovative',
    'registration_number' => '98596',
    'incorporated_on' => '3 January 2012',

    'contact' => [
        'address_lines' => [
            'Stand No. 3, ECL Business Park, 2nd Floor',
            'P.O. Box 20815, Kitwe, Copperbelt, Zambia',
        ],
        'short_address' => 'Stand No. 3, ECL Business Park, Kitwe, Zambia',
        'phones' => ['+260 966 328 975', '+260 776 649 100'],
        'email' => 'info@mvindustrialzm.com',
        'website' => 'https://www.mvindustrialzm.com',
        'website_label' => 'www.mvindustrialzm.com',
    ],

    // Set a URL to null to hide that icon in the footer.
    'social' => [
        'facebook' => 'https://www.facebook.com/',
        'linkedin' => 'https://www.linkedin.com/',
        'whatsapp' => 'https://wa.me/260966328975',
    ],

    // Entries use either a section anchor on the home page or a named route.
    'navigation' => [
        ['key' => 'home', 'label' => 'Home', 'href' => '/#home'],
        ['key' => 'services', 'label' => 'Services', 'route' => 'services'],
        ['key' => 'products', 'label' => 'Products', 'route' => 'products'],
        ['key' => 'about', 'label' => 'About', 'route' => 'about'],
        ['key' => 'contact', 'label' => 'Contact', 'route' => 'contact'],
    ],

    'office_hours' => [
        ['days' => 'Monday to Friday', 'hours' => '08:00 - 17:00'],
        ['days' => 'Saturday', 'hours' => '08:00 - 13:00'],
        ['days' => 'Sunday and public holidays', 'hours' => 'Closed'],
    ],

    'compliance' => [
        'Incorporated under the Companies Act (388) on 3 January 2012, registration number 98596.',
        'Registered with the Workers\' Compensation Fund Control Board.',
        'Wholly Zambian-owned and operated from the Copperbelt.',
    ],

    'enquiry_topics' => [
        'Industrial & Mining Supplies',
        'Labour Hire & Workforce',
        'Procurement Services',
        'Construction & Civil Engineering',
        'Mechanical Engineering',
        'General enquiry',
    ],

    'stats' => [
        ['value' => '12+', 'label' => 'Years in operation'],
        ['value' => '50+', 'label' => 'Projects completed'],
        ['value' => '100+', 'label' => 'Workforce supplied'],
        ['value' => '5+', 'label' => 'Sectors served'],
    ],

    'services' => [
        [
            'icon' => 'engineering',
            'slug' => 'labour-hire',
            'title' => 'Labour Hire & Workforce',
            'summary' => 'Certified technicians, operators and general labourers trained in occupational health and safety, ready to integrate into your teams.',
            'points' => [
                'Flexible short and long-term contracts',
                'Safety-first, site-ready personnel',
                'Scaled to project timeline and budget',
            ],
        ],
        [
            'icon' => 'inventory_2',
            'slug' => 'procurement',
            'title' => 'Procurement Services',
            'summary' => 'End-to-end sourcing from reputable local and international manufacturers, with logistics handled from order to delivery.',
            'points' => [
                'Competitive pricing and negotiation',
                'Customs clearance and coordination',
                'Timely, secure delivery',
            ],
        ],
        [
            'icon' => 'foundation',
            'slug' => 'construction-civil-engineering',
            'title' => 'Construction & Civil Engineering',
            'summary' => 'Ground-up builds, renovations and infrastructure delivered with precision, safety and durability at the core.',
            'points' => [
                'Residential, commercial and industrial builds',
                'Roads, bridges, housing and drainage',
                'Structural design and concrete maintenance',
            ],
        ],
        [
            'icon' => 'settings',
            'slug' => 'mechanical-engineering',
            'title' => 'Mechanical Engineering',
            'summary' => 'Machine installation, maintenance and overhaul backed by custom fabrication and precision welding.',
            'points' => [
                'Gear systems, couplings and transmission',
                'Pneumatic and hydraulic systems',
                'Structural and functional steelwork',
            ],
        ],
        [
            'icon' => 'health_and_safety',
            'title' => 'Health & Safety First',
            'summary' => 'Safety is a commitment, not a checkbox. We work to strict health and safety protocols on every project so risks stay minimised and standards are never compromised.',
            'points' => [],
            'accent' => true,
        ],
    ],

    'services_intro' => 'From certified workforce solutions to full construction and mechanical engineering delivery, we work as a single accountable partner across the mining and industrial value chain.',

    'service_details' => [
        [
            'slug' => 'labour-hire',
            'icon' => 'engineering',
            'title' => 'Labour Hire & Workforce Solutions',
            'topic' => 'Labour Hire & Workforce',
            'lead' => 'We provide skilled, semi-skilled and general labour to mining and industrial clients, screened and trained in occupational health and safety before they set foot on site. Contracts flex with your project timeline and budget, and our teams integrate directly into your existing structures.',
            'image' => 'labour-hire.jpg',
            'alt' => 'Workforce team in personal protective equipment on site',
            'points' => [
                'Certified technicians, artisans and machine operators',
                'General labourers for shutdowns and peak periods',
                'Short-term, long-term and project-based contracts',
                'Occupational health and safety induction for every placement',
                'Payroll, statutory compliance and supervision handled by us',
                'Replacement cover so your production schedule holds',
            ],
        ],
        [
            'slug' => 'procurement',
            'icon' => 'inventory_2',
            'title' => 'Procurement Services',
            'topic' => 'Procurement Services',
            'lead' => 'Our procurement team manages the full cycle from sourcing to delivery, drawing on local and international supplier relationships to secure the right item at the right price. You deal with one point of contact while we handle negotiation, clearing and logistics.',
            'image' => 'procurement.jpg',
            'alt' => 'Warehouse shelving stocked with industrial supplies',
            'points' => [
                'Sourcing from vetted local and international manufacturers',
                'Competitive pricing through negotiated supplier terms',
                'Import documentation and customs clearance',
                'Freight coordination, warehousing and secure delivery',
                'Quality verification against your specification before dispatch',
                'Transparent reporting on lead times and order status',
            ],
        ],
        [
            'slug' => 'construction-civil-engineering',
            'icon' => 'foundation',
            'title' => 'General Construction & Civil Engineering',
            'topic' => 'Construction & Civil Engineering',
            'lead' => 'We deliver ground-up builds, renovations and infrastructure works with precision, safety and durability at the core. Our civil capability extends from equipment bases and concrete repair through to housing developments and steel fabrication.',
            'image' => 'construction.jpg',
            'alt' => 'Civil engineering works under construction',
            'points' => [
                'Residential, commercial and industrial building works',
                'Roads, bridges, drainage and site infrastructure',
                'Machine and equipment concrete bases',
                'Concrete repair, maintenance and structural rehabilitation',
                'Structural steel fabrication and erection',
                'Low and middle income housing developments',
            ],
        ],
        [
            'slug' => 'mechanical-engineering',
            'icon' => 'settings',
            'title' => 'Mechanical Engineering Services',
            'topic' => 'Mechanical Engineering',
            'lead' => 'From installation and routine maintenance to full overhauls, our mechanical teams keep plant and machinery running at capacity. Custom fabrication and precision welding are handled in-house so repairs are turned around without waiting on third parties.',
            'image' => 'mechanical.jpg',
            'alt' => 'Technician servicing mechanical plant equipment',
            'points' => [
                'Machine installation, commissioning and alignment',
                'Preventive maintenance and scheduled servicing',
                'Overhaul of gear systems, couplings and transmissions',
                'Pneumatic and hydraulic system repair',
                'Custom fabrication and precision welding',
                'Structural and functional steelwork on site',
            ],
        ],
    ],

    'products_intro' => 'We source and stock industrial and mining consumables, spares and equipment from reputable manufacturers, held to the standards Copperbelt operations demand. Stock is matched to your plant so downtime stays short and specifications are never compromised.',

    'products' => [
        [
            'slug' => 'electrical-items',
            'icon' => 'bolt',
            'title' => 'Electrical Items',
            'summary' => 'Contactors, relays, switchgear and instrumentation for panel builds, motor control and site electrical work.',
            'items' => [
                'Contactors, control relays and overload relays',
                'Fuse holders, bases, cartridges and links',
                'Switchgear, isolators and industrial sockets',
                'Cables, cable lugs, glands and connectors',
                'Earth leakage relays and insulation testers',
                'Lighting accessories and indicator lamps',
                'Electrical motors and current transformers',
            ],
        ],
        [
            'slug' => 'bearings-milling-tools',
            'icon' => 'precision_manufacturing',
            'title' => 'Bearings & Milling Tools',
            'summary' => 'Bearings, housings and milling tooling sized to keep rotating equipment running.',
            'items' => [
                'Ball, roller and needle bearings',
                'Y-bearings and adapter sleeves',
                'Bearing housings and thrust housings',
                'Plummer blocks',
                'Mill liners and grinding media',
                'Cutting and milling tooling',
            ],
        ],
        [
            'slug' => 'drilling-rock-tools',
            'icon' => 'construction',
            'title' => 'Drilling & Rock Tools',
            'summary' => 'Rock drills, bits and accessories built for underground and open-pit drilling.',
            'items' => [
                'Jack hammers and drill rods',
                'Shanks and couplings',
                'Drill bits: button, reamer and ballistic',
                'Pneumatic drilling accessories',
            ],
        ],
        [
            'slug' => 'welding-equipment',
            'icon' => 'local_fire_department',
            'title' => 'Welding Equipment',
            'summary' => 'Welding machines, electrodes and torches for fabrication and site repair work.',
            'items' => [
                'Cast iron, mild steel, low hydrogen and stainless electrodes',
                'Welding machines and consumables',
                'Multi-purpose welders and cutting torches',
                'Welding goggles, handlers and clamps',
                'Heating and welding blow torches',
            ],
        ],
        [
            'slug' => 'fluid-valve-systems',
            'icon' => 'water_drop',
            'title' => 'Fluid & Valve Systems',
            'summary' => 'Pumps, valves and treatment equipment for water reticulation and steam applications.',
            'items' => [
                'Gate, butterfly, ball and slurry valves',
                'Pumps for water and acidic applications',
                'Water treatment and filtration systems',
                'Cooling equipment and water heaters',
                'Pipe fittings',
            ],
        ],
        [
            'slug' => 'mechanical-products-spares',
            'icon' => 'build',
            'title' => 'Mechanical Products & Spares',
            'summary' => 'Fasteners, transmission parts and consumables to keep plant and machinery in service.',
            'items' => [
                'Fasteners and fittings',
                'Power transmission components',
                'Pneumatics and hydraulics',
                'Tool boxes and tool storage',
                'Adhesives, lubricants and cleaning equipment',
            ],
        ],
        [
            'slug' => 'safety-equipment-clothing',
            'icon' => 'shield',
            'title' => 'Safety Equipment & Clothing',
            'summary' => 'Certified PPE for site teams, from headwear to respiratory protection.',
            'items' => [
                'Hard hats and safety boots',
                'Overalls, rain coats and rain suits',
                'Goggles and leather or PVC gloves',
                'Industrial aprons and safety belts',
                'Ear plugs and respirators',
            ],
        ],
        [
            'slug' => 'abrasives-tools-hardware',
            'icon' => 'handyman',
            'title' => 'Abrasives, Tools & Hardware',
            'summary' => 'General hand tools, abrasives and hardware alongside motor vehicle spares.',
            'items' => [
                'Abrasives and machine tools',
                'General hand and hardware tools',
                'Belts, bolts and nuts',
                'Motor vehicle spares',
            ],
        ],
    ],

    'safety' => [
        'title' => 'Health & Safety First',
        'lead' => 'Safety is a commitment, not a checkbox. Every placement, site team and delivery works to strict health and safety protocols, so risks stay minimised and standards are never compromised.',
        'image' => 'safety-ppe.png',
        'alt' => 'Full set of personal protective equipment',
        'points' => [
            'Registered with the Workers\' Compensation Fund Control Board',
            'Documented risk assessments before work begins',
            'Certified personal protective equipment issued as standard',
            'Ongoing safety training and toolbox talks',
        ],
    ],

    'values' => [
        [
            'icon' => 'workspace_premium',
            'title' => 'Excellence',
            'description' => 'Best practices and superior standards across every work process.',
        ],
        [
            'icon' => 'verified',
            'title' => 'Integrity',
            'description' => 'Honesty, professionalism and ethical responsibility in all dealings.',
        ],
        [
            'icon' => 'groups',
            'title' => 'People Development',
            'description' => "Investing in our team's growth, welfare and long-term success.",
        ],
    ],

    'about_story' => [
        'Incorporated under the Companies Act (388) on 3 January 2012, MV Industrial & Mining Supplies Limited began as a supplier of industrial consumables to the Copperbelt and has grown into a multi-disciplinary partner spanning supplies, workforce solutions, procurement, construction and mechanical engineering.',
        'We are wholly Zambian-owned and operated from Kitwe, close to the operations we serve. That proximity is deliberate: it keeps lead times short, lets our teams mobilise quickly and means the people accountable for your order are reachable on the ground.',
        'Our commitment to excellence drives us to supply premium products that comply with both local and international standards. We believe customer satisfaction is achieved through teamwork, integrity and continuous improvement, and we invest in our people so that every placement reflects it.',
    ],

    'differentiators' => [
        [
            'icon' => 'public',
            'title' => 'Zambian-owned and locally based',
            'description' => 'Operating from Kitwe on the Copperbelt, we are close to the mines and plants we serve, which keeps mobilisation and lead times short.',
        ],
        [
            'icon' => 'hub',
            'title' => 'One accountable partner',
            'description' => 'Supplies, labour, procurement, construction and mechanical engineering under a single contract, so there is no gap between disciplines.',
        ],
        [
            'icon' => 'verified_user',
            'title' => 'Certified and compliant',
            'description' => 'Registered with the Workers\' Compensation Fund Control Board, with documented risk assessments and certified PPE on every placement.',
        ],
        [
            'icon' => 'inventory',
            'title' => 'Quality without compromise',
            'description' => 'We source from reputable manufacturers and verify against your specification before dispatch, so what arrives is what you ordered.',
        ],
        [
            'icon' => 'schedule',
            'title' => 'Delivery you can plan around',
            'description' => 'Transparent lead times, coordinated freight and clearing, and replacement cover so your production schedule holds.',
        ],
        [
            'icon' => 'diversity_3',
            'title' => 'People we invest in',
            'description' => 'Training, welfare and long-term development for our teams, because the standard of the work follows the standard of the people.',
        ],
    ],

    'vision' => 'To become Zambia\'s most trusted provider of industrial, mining and engineering solutions, recognised for unmatched quality and client-centric service.',
    'mission' => 'To drive customer success by delivering customised, high-quality solutions built on integrity, innovation and excellence.',

    'clients' => [
        ['name' => 'Konkola Copper Mines Plc', 'logo' => 'konkola-copper-mines.svg'],
        ['name' => 'Mopani Copper Mines', 'logo' => 'mopani-copper-mines.svg'],
        ['name' => 'Kansanshi Mining Plc', 'logo' => 'kansanshi-mining.svg'],
        ['name' => 'Lubambe Copper Mine', 'logo' => 'lubambe-copper-mine.svg'],
        ['name' => 'CNMC Luanshya Copper Mines', 'logo' => 'cnmc-luanshya.svg'],
        ['name' => 'UNICEF', 'logo' => 'unicef.svg'],
        ['name' => 'Save the Children', 'logo' => 'save-the-children.svg'],
        ['name' => 'CIDRZ', 'logo' => 'cidrz.svg'],
        ['name' => 'Right to Care', 'logo' => 'right-to-care.svg'],
        ['name' => 'Project HOPE', 'logo' => 'project-hope.svg'],
        ['name' => 'Occupational Health and Safety Institute', 'logo' => 'occupational-health-safety-institute.svg'],
    ],

    'clients_note' => 'We also serve Kitwe Health Management Board, U and M Mining, Madison Insurance Limited, the Anglican Northern Diocese of Zambia, Zambia Forestry College and a range of government institutions.',

];
