@extends('auth.layouts')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-8">

        <div class="flex justify-center mt-5">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
                <div class="mb-4">
                    @if ($message = Session::get('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p class="font-bold">Success!</p>
                            <p>{{ $message }}</p>
                        </div>
                    @else
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p class="font-bold">Success!</p>
                            <p>You are logged in!</p>
                        </div>
                    @endif
                </div>

                <header class="text-center mb-8">
                    <h1 class="text-4xl font-bold">Muhammad Syuja Rizqullah</h1>
                    <section id="kontak" class="mb-8 mt-5">
                        <div class="mx-auto text-center grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <p>muhammadsyujarizqullah@mail.ugm.ac.id</p>
                            </div>
                            <div>
                                <p>+6285156071855</p>
                            </div>
                            <div>
                                <p>Gramapuri Tamansari, Bekasi, Jawa Barat</p>
                            </div>
                        </div>
                    </section>
                    <p class="text-gray-600">I am an individual who is actively involved in the creative industry and has been engaged in the field of documentation since 2019 until present time. I am actively participating in short movie competitions and have been involved in documenting for committees as well as designing social media content for organizations. My experience in utilizing cameras is vast, encompassing various brands such as Canon, Sony, and Nikon. Additionally, I possess the skill and expertise in operating camera- related equipment, including gimbal stabilizers, lighting, and audio equipment.</p>
                </header>

                <section id="pendidikan" class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Pendidikan</h2>
                    <div>
                        <h3 class="text-xl font-bold">Universitas Gadjah Mada</h3>
                        <p>Undergraduate in Software Engineering Technology (2022)</p>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-bold">SMA N 1 Tambun Selatan</h3>
                        <p>High School Diploma in Mathematics and Science (2019-2022)</p>
                    </div>
                </section>

                <section id="pengalaman" class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Organization, Committee & Volunteer Experience</h2>
                    <div>
                        <h3 class="text-xl font-bold">Festival Gadjah Mada 2023</h3>
                        <p>Multimedia Staff.</p>
                        <p>- Documented all of event activities.</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">BEM KM UGM Sauh Resiliensi Cabinet</h3>
                        <p>Advocacy and Student Welfare Media and Networking Staff.</p>
                        <p>- Creating social media designs for Instagram @bemkm_ugm for student advocacy and welfare.</p>
                        <p>- Creating social media designs for Instagram @adkesgram_ugm.</p>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-bold">ASSETS UGM Orion Cabinet</h3>
                        <p>Creative Staff Division.</p>
                        <p>- Creating social media designs for Instagram @assets_ugm.</p>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-bold">Gadjah Mada Event in Bekasi Faculty Fair 2023</h3>
                        <p>Volunteer</p>
                        <p>- Introduced faculties, majors, and study programs to prospective students at the faculty fair.</p>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-bold">Darah Juang Festival 2022</h3>
                        <p>Design, Decoration and Documentation Staff.</p>
                        <p>- Documented the event activities.</p>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-bold">Tech Enthusiast Day 2022</h3>
                        <p>Design, Decoration and Documentation Staff.</p>
                        <p>- Documented the competition event.</p>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-bold">After Graduation Party Mavienza SMA N 1 Tambun Selatan</h3>
                        <p>Multimedia Head Division</p>
                        <p>- Organized the multimedia of the graduation party Mavienza.</p>
                        <p>- Supervised the photobooth of the graduation party Mavienza.</p>
                    </div>
                    
                </section>

                <section id="keterampilan" class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Skills</h2>
                    <ul class="list-disc list-inside">
                        <li>Hard Skills: Photography, Videography, Director of Photography, Video Editing, Social Media Design</li>
                        <li>Soft Skills: Teamwork, Flexibility, Ability to work under pressure, Open-mindedness, Patience.</li>
                    </ul>
                </section>

            </div>
        </div>

    </div>

</body>

</html>


@endsection
