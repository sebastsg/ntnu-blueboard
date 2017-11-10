<?php

function install_department($faculty_code, $department_code, $department) {
    create_department($faculty_code, $department_code, $department['name']);
    foreach ($department['courses'] as $course_code => $course) {
        create_course($department_code, $course_code, $course['name'], '', $course['exam'], $course['credits']);
    }
    foreach ($department['programs'] as $program_code => $program) {
        create_program($department_code, $program_code, $program['name']);
        foreach ($program['courses'] as $course_code => $is_mandatory) {
            create_course_in_program($program_code, $course_code, $is_mandatory);
        }
    }
}

function install_organization($faculties) {
    foreach ($faculties as $faculty_code => $faculty) {
        create_faculty($faculty_code, $faculty['name']);
        foreach ($faculty['departments'] as $department_code => $department) {
            install_department($faculty_code, $department_code, $department);
        }
    }
}

install_organization([

	'IE' => [
		'name' => 'Information Technology and Electrical Engineering',
		'departments' => [
			'IDI' => [
				'name' => 'Computer Science',
				'courses' => [],
				'programs' => []
			],
			'IMF' => [
				'name' => 'Mathematical Sciences',
				'courses' => [],
				'programs' => []
			],
			'IAL' => [
				'name' => 'General Science',
				'courses' => [],
				'programs' => []
			],
			'IES' => [
				'name' => 'Electronic Systems',
				'courses' => [],
				'programs' => []
			],
			'IIK' => [
				'name' => 'Information Security and Communication Technology',
				'courses' => [],
				'programs' => []
			],
			'IIR' => [
				'name' => 'ICT and Natural Sciences',
				'courses' => [
					'ID101912' => [
						'name' => 'Object-oriented programming',
						'credits' => 10,
						'exam' => 'digital'
					],
					'ID102012' => [
						'name' => 'Web Technology',
						'credits' => 10,
						'exam' => 'oral'
					],
					'ID202912' => [
						'name' => 'Data modeling and database applications',
						'credits' => 10,
						'exam' => 'oral'
					],
					'ID203012' => [
						'name' => 'Computer communication with network programming',
						'credits' => 10,
						'exam' => 'digital'
					],
					'IE100212' => [
						'name' => 'Microcontrollers',
						'credits' => 10,
						'exam' => 'digital'
					],
					'ID202812' => [
						'name' => 'Operating Systems',
						'credits' => 10,
						'exam' => 'digital'
					],
					'ID202712' => [
						'name' => 'Systems development and modeling',
						'credits' => 10,
						'exam' => 'digital'
					],
					'IR201812' => [
						'name' => 'Statistics and simulation',
						'credits' => 10,
						'exam' => 'digital'
					],
					'IE303312' => [
						'name' => 'Intelligent Systems',
						'credits' => 10,
						'exam' => 'digital'
					],
					'IE303812' => [
						'name' => 'Real Time Programming',
						'credits' => 10,
						'exam' => 'digital'
					],
					'IR102512' => [
						'name' => 'Mathematics 1',
						'credits' => 10,
						'exam' => 'written'
					],
				],
				'programs' => [
					'004DA' => [
						'name' => 'Computer Science',
						'courses' => [
							'IE100212' => true,
							'IR201812' => true,
							'IR102512' => true,
							'ID102012' => true,
							'ID101912' => true,
							'ID202912' => true,
							'ID203012' => true,
							'ID202812' => true,
							'ID202712' => true,
						],
					],
					'017AU' => [
						'name' => 'Automation',
						'courses' => [
							'IR102512' => true,
						],
					],
					'006EK' => [
						'name' => 'Power Electronics',
						'courses' => [
							'IR102512' => true,
						],
					],
					'045PS' => [
						'name' => 'Product and System Design',
						'courses' => [
							'IR102512' => true,
						],
					],
					'699YV' => [
						'name' => 'Ship Design',
						'courses' => [
							'IR102512' => true,
						],
					],
					'561VM' => [
						'name' => 'Water and Environmental Engineering',
						'courses' => [
							'IR102512' => true,
						],
					],
					'003YV' => [
						'name' => 'Civil Engineering',
						'courses' => [
							'IR102512' => true,
						],
					],
				],
			],
		],
	],
	'AD' => [
		'name' => 'Architecture and Design',
		'departments' => [
			'KIT' => [
				'name' => 'Fine Art',
				'courses' => [],
				'programs' => []
			],
			'ID' => [
				'name' => 'Design',
				'courses' => [],
				'programs' => []
			],
			'IAT' => [
				'name' => 'Architecture and Technology',
				'courses' => [],
				'programs' => []
			],
			'IAP' => [
				'name' => 'Architecture and Planning',
				'courses' => [],
				'programs' => []
			],
		],
	],
	'HF' => [
		'name' => 'Humanities',
		'departments' => [
			'MUS' => [
				'name' => 'Music',
				'courses' => [],
				'programs' => []
			],
			'IKM' => [
				'name' => 'Art and Media Studies',
				'courses' => [],
				'programs' => []
			],
			'IHS' => [
				'name' => 'Historical Studies',
				'courses' => [],
				'programs' => []
			],
			'IFR' => [
				'name' => 'Philosophy and Religious Studies',
				'courses' => [],
				'programs' => []
			],
			'ISL' => [
				'name' => 'Language and Literature',
				'courses' => [],
				'programs' => []
			],
		],
	],
	'IV' => [
		'name' => 'Engineering',
		'departments' => [
			'EPT' => [
				'name' => 'Energy and Process Engineering',
				'courses' => [],
				'programs' => []
			],
			'IMT' => [
				'name' => 'Marine Technology',
				'courses' => [],
				'programs' => []
			],
			'MTP' => [
				'name' => 'Mechanical and Industrial Engineering',
				'courses' => [],
				'programs' => []
			],
			'IGP' => [
				'name' => 'Geoscience and Petroleum',
				'courses' => [],
				'programs' => []
			],
		],
	],
	'MH' => [
		'name' => 'Medicine and Health Sciences',
		'departments' => [
			'INB' => [
				'name' => 'Neuromedicine and Movement Science',
				'courses' => [],
				'programs' => []
			],
			'IPH' => [
				'name' => 'Mental Health',
				'courses' => [],
				'programs' => []
			],
			'ISM' => [
				'name' => 'Public Health and Nursing',
				'courses' => [],
				'programs' => []
			],
			'ISB' => [
				'name' => 'Circulation and Medical Imaging',
				'courses' => [],
				'programs' => []
			],
		],
	],
	'NV' => [
		'name' => 'Natural Sciences',
		'departments' => [
			'IBT' => [
				'name' => 'Biotechnology and Food Science',
				'courses' => [],
				'programs' => []
			],
			'IBF' => [
				'name' => 'Biomedical Laboratory Science',
				'courses' => [],
				'programs' => []
			],
			'IBA' => [
				'name' => 'Biological Sciences',
				'courses' => [],
				'programs' => []
			],
		],
	],
	'SU' => [
		'name' => 'Social and Educational Sciences',
		'departments' => [
			'IGE' => [
				'name' => 'Geography',
				'courses' => [],
				'programs' => []
			],
			'ILU' => [
				'name' => 'Teacher Education',
				'courses' => [],
				'programs' => []
			],
			'IPL' => [
				'name' => 'Education and Lifelong Learning',
				'courses' => [],
				'programs' => []
			],
			'ISA' => [
				'name' => 'Social Work',
				'courses' => [],
				'programs' => []
			],
			'IPS' => [
				'name' => 'Psychology',
				'courses' => [],
				'programs' => []
			],
		],
	],
	'OK' => [
		'name' => 'Economics and Management',
		'departments' => [
			'IIF' => [
				'name' => 'International Business',
				'courses' => [],
				'programs' => []
			],
			'IOT' => [
				'name' => 'Industrial Economics and Technology Management',
				'courses' => [],
				'programs' => []
			],
		],
	],
]);

set_course_description('ID101912',
'
<h2>Course content</h2>
<ul>
	<li>User interface</li>
	<li>Application programs, jobs, processes and threads</li>
	<li>Memory and storage</li>
	<li>I/O devices and communication</li>
	<li>Hardware and hardware architecture</li>
	<li>Security</li>
</ul>

<h2>Learning outcome</h2>
<h3>Knowledge</h3>
<ul>
	<li>have knowledge of computer components</li>
	<li>know how the hardware and the operating system interact</li>
	<li>know the characteristics of the most common operating systems and the history of their development up to modern systems</li>
	<li>have detailed knowledge of the internal modules of operating systems</li>
</ul>
<h3>Skills</h3>
<ul>
	<li>be able to perform installation of common operating systems</li>
	<li>be able to perform routine maintenance of at least one common operating system for personal computers</li>
	<li>be able to use common system utilities to check system status and give advice on system upgrading</li>
	<li>have knowledge of the trends of modern operating systems</li>
</ul>
<h3>Competence</h3>
<ul>
	<li>know the typical utilization of different operating systems</li>
	<li>know the trends in the development of modern operating systems</li>
	<li>be able to communicate key aspects of the topic to peers</li>
</ul>

<h2>Learning methods and activities</h2>

<h3>Pedagogical methods</h3>
<p>
Lecturing, exercises and lab assignments 
</p>

<h3>Mandatory work requirements</h3>
<p>
The student must have a portfolio containing all the mandatory assignments and projects.
</p>

<h2>Specific conditions</h2>
<p>
Exam registration requires that class registration is approved in the same semester. Compulsory activities from previous semester may be approved by the department.
</p>

');
