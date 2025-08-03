

@include('Teacher.inc.header')
@include('Teacher.inc.menu')
@extends('Teacher.inc.nav')
@section('title','Profile')


@section('page_content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Courses Viewer</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 30px;
        background-color: #f7f7f7;
        }

        .section {
        margin-bottom: 20px;
        }

        .item {
        padding: 10px;
        background-color: white;
        border: 1px solid #ccc;
        margin: 5px 0;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
        }

        .item:hover {
        background-color: #e0f7fa;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        background-color: white;
        }

        th, td {
        border: 1px solid #ddd;
        padding: 8px;
        }

        th {
        background-color: #00bcd4;
        color: white;
        }

        .hidden {
        display: none;
        }
    </style>
    </head>
    <body>

    <h1>Courses</h1>

    <div id="courses" class="section"></div>
    <div id="chapters" class="section hidden">
        <h2>Chapters</h2>
        <div id="chapters-list"></div>
    </div>
    <div id="lessons" class="section hidden">
        <h2>Lessons</h2>
        <div id="lessons-list"></div>
    </div>
    <div id="sessions" class="section hidden">
        <h2>Sessions</h2>
        <table>
        <thead>
            <tr>
            <th>Title</th>
            <th>Duration</th>
            <th>Date</th>
            </tr>
        </thead>
        <tbody id="sessions-table"></tbody>
        </table>
    </div>

    <script>
        const data = {
        courses: [
            {
            id: 1,
            title: "Web Development",
            chapters: [
                {
                id: 1,
                title: "HTML Basics",
                lessons: [
                    {
                    id: 1,
                    title: "Intro to HTML",
                    sessions: [
                        { title: "Session 1", duration: "30 mins", date: "2025-08-01" },
                        { title: "Session 2", duration: "25 mins", date: "2025-08-02" }
                    ]
                    }
                ]
                }
            ]
            },
            {
            id: 2,
            title: "JavaScript Mastery",
            chapters: [
                {
                id: 1,
                title: "Fundamentals",
                lessons: [
                    {
                    id: 1,
                    title: "Variables",
                    sessions: [
                        { title: "Session A", duration: "40 mins", date: "2025-08-01" },
                        { title: "Session B", duration: "35 mins", date: "2025-08-03" }
                    ]
                    }
                ]
                }
            ]
            }
        ]
        };

        const coursesDiv = document.getElementById("courses");
        const chaptersDiv = document.getElementById("chapters");
        const chaptersList = document.getElementById("chapters-list");
        const lessonsDiv = document.getElementById("lessons");
        const lessonsList = document.getElementById("lessons-list");
        const sessionsDiv = document.getElementById("sessions");
        const sessionsTable = document.getElementById("sessions-table");

        let selectedCourse = null;
        let selectedChapter = null;

        function renderCourses() {
        coursesDiv.innerHTML = '';
        data.courses.forEach(course => {
            const div = document.createElement('div');
            div.className = 'item';
            div.innerText = course.title;
            div.onclick = () => {
            selectedCourse = course;
            renderChapters(course.chapters);
            };
            coursesDiv.appendChild(div);
        });
        }

        function renderChapters(chapters) {
        chaptersDiv.classList.remove('hidden');
        lessonsDiv.classList.add('hidden');
        sessionsDiv.classList.add('hidden');
        chaptersList.innerHTML = '';
        chapters.forEach(ch => {
            const div = document.createElement('div');
            div.className = 'item';
            div.innerText = ch.title;
            div.onclick = () => {
            selectedChapter = ch;
            renderLessons(ch.lessons);
            };
            chaptersList.appendChild(div);
        });
        }

        function renderLessons(lessons) {
        lessonsDiv.classList.remove('hidden');
        sessionsDiv.classList.add('hidden');
        lessonsList.innerHTML = '';
        lessons.forEach(lesson => {
            const div = document.createElement('div');
            div.className = 'item';
            div.innerText = lesson.title;
            div.onclick = () => {
            renderSessions(lesson.sessions);
            };
            lessonsList.appendChild(div);
        });
        }

        function renderSessions(sessions) {
        sessionsDiv.classList.remove('hidden');
        sessionsTable.innerHTML = '';
        sessions.forEach(session => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${session.title}</td>
            <td>${session.duration}</td>
            <td>${session.date}</td>
            `;
            sessionsTable.appendChild(row);
        });
        }

        // Start rendering
        renderCourses();
    </script>
    </body>
    </html>

@endsection
@include('Teacher.inc.footer')
