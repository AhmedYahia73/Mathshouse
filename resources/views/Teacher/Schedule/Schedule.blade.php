

@include('Teacher.inc.header')
@include('Teacher.inc.menu')
@extends('Teacher.inc.nav')
@section('title','Profile')

@section('page_content')
<style>
    .item {
        padding: 10px;
        background-color: white;
        border: 1px solid #ccc;
        margin: 5px 0;
        cursor: pointer;
        border-radius: 5px;
    }
    .nested {
        margin-left: 20px;
        margin-top: 5px;
    }
    .hidden { display: none; }

    table {
        width: 95%;
        margin: 10px;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 6px;
        text-align: left;
    }

    th {
        background-color: #00bcd4;
        color: white;
    }

    button {
        background-color: #2196F3;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 3px;
    }

    button:hover {
        background-color: #0b7dda;
    }

    .students-list {
        background-color: #f1f1f1;
        margin-left: 40px;
        padding: 8px;
        border-left: 2px solid #00bcd4;
    }
</style>

<h2>Courses</h2>
<div id="courses-container"></div>

<script>
    const data = {};
    let courses = @json($courses);  
    console.log(courses); 
    courses = courses.map(course => ({
        id: course.id,
        title: course.course_name,
        chapters: (course.chapter || []).map(ch => ({
            id: ch.id,
            title: ch.chapter_name,
            lessons: (ch.lessons || []).map(lesson => ({
                id: lesson.id,
                title: lesson.lesson_name,
                sessions: (lesson.sessions || []).map(sess => ({
                    name: sess.name,
                    date: sess.date,
                    from: sess.from,
                    to: sess.to,
                    students: (sess.users || []).map(u => ({
                        id: u.id,
                        name: u.nick_name,
                    })),
                }))
            }))
        }))
    }));

    data.courses = courses;

    const container = document.getElementById('courses-container');

    function createItem(title, onClick) {
        const div = document.createElement('div');
        div.className = 'item';
        div.textContent = title;
        div.onclick = onClick;
        return div;
    }

    function renderCourses() {
        data.courses.forEach(course => {
            const courseDiv = createItem(course.title, () => {
                if (chaptersDiv.classList.contains('hidden')) {
                    chaptersDiv.classList.remove('hidden');
                } else {
                    chaptersDiv.classList.add('hidden');
                }
            });
            const chaptersDiv = document.createElement('div');
            chaptersDiv.className = 'nested hidden';

            course.chapters.forEach(ch => {
                const chapterDiv = createItem(ch.title, () => {
                    if (lessonsDiv.classList.contains('hidden')) {
                        lessonsDiv.classList.remove('hidden');
                    } else {
                        lessonsDiv.classList.add('hidden');
                    }
                });
                const lessonsDiv = document.createElement('div');
                lessonsDiv.className = 'nested hidden';

                ch.lessons.forEach(lesson => {
                    const lessonDiv = createItem(lesson.title, () => {
                        if (sessionDiv.classList.contains('hidden')) {
                            sessionDiv.classList.remove('hidden');
                        } else {
                            sessionDiv.classList.add('hidden');
                        }
                    });

                    const sessionDiv = document.createElement('div');
                    sessionDiv.className = 'nested hidden';

                    const table = document.createElement('table');
                    table.innerHTML = `
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Students</th>
                            </tr>
                        </thead>
                        <tbody>
                        ${lesson.sessions.map(session => `
                            <tr>
                                <td>${session.name}</td>
                                <td>${session.date}</td>
                                <td>${session.from}</td>
                                <td>${session.to}</td>
                                <td>
                                    <button onclick="toggleStudents(this)">View Students</button>
                                    <div class="students-list hidden">
                                        ${session.students.map(st => `<div>• ${st.name}</div>`).join('')}
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                        </tbody>
                    `;
                    sessionDiv.appendChild(table);
                    lessonsDiv.appendChild(lessonDiv);
                    lessonsDiv.appendChild(sessionDiv);
                });

                chaptersDiv.appendChild(chapterDiv);
                chaptersDiv.appendChild(lessonsDiv);
            });

            container.appendChild(courseDiv);
            container.appendChild(chaptersDiv);
        });
    }

    function toggleStudents(button) {
        const studentDiv = button.nextElementSibling;
        studentDiv.classList.toggle('hidden');
    }

    renderCourses();
</script>
@endsection

@include('Teacher.inc.footer')
