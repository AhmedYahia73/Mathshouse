@php 
    function fun_admin() { 
        return "admin"; 
    } 
@endphp
<x-default-layout>
    @section('title', 'Notification')
    @include('success')

    <style>
        .report-container {
            max-width: 1100px;
            margin: 20px auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .report-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        .report-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .summary {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        .summary-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            flex: 1 1 150px;
            text-align: center;
        }
        .summary-item h3 {
            margin: 0;
            font-size: 18px;
            color: #007bff;
        }
        .summary-item p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table thead {
            background: #007bff;
            color: #fff;
        }
        table th, table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table tbody tr:hover {
            background: #f1f1f1;
        }
    </style>

    <div class="report-container">
        <div id="report"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const data = {{ $data }}

        function renderTable(title, details) {
            if (!details || details.length === 0) return "";
            let html = `<h4>${title}</h4><table><thead><tr><th>Course</th><th>Number</th></tr></thead><tbody>`;
            details.forEach(item => {
                html += `<tr><td>${item.course ?? '-'}</td><td>${item.number}</td></tr>`;
            });
            html += "</tbody></table>";
            return html;
        }

        $(function(){
            let html = "";
            data.forEach(item => {
                html += `
                    <div class="report-card">
                        <div class="report-header">${item.nick_name} (ID: ${item.id}) - Phone: ${item.phone}</div>
                        <div class="summary">
                            <div class="summary-item"><h3>${item.live_count}</h3><p>Lives</p></div>
                            <div class="summary-item"><h3>${item.question_count}</h3><p>Questions</p></div>
                            <div class="summary-item"><h3>${item.exam_count}</h3><p>Exams</p></div>
                            <div class="summary-item"><h3>${item.exam_history_count}</h3><p>Exam History</p></div>
                            <div class="summary-item"><h3>${item.question_history_count}</h3><p>Question History</p></div>
                            <div class="summary-item"><h3>${item.live_history_count}</h3><p>Live History</p></div>
                        </div>
                        ${renderTable("Live Details", item.live_details)}
                        ${renderTable("Question Details", item.question_details)}
                        ${renderTable("Exam Details", item.exam_details)}
                        ${renderTable("Exam History Details", item.exam_history_details)}
                        ${renderTable("Question History Details", item.question_history_details)}
                        ${renderTable("Live History Details", item.live_history_details)}
                    </div>
                `;
            });
            $("#report").html(html);
        });
    </script>
 
</x-default-layout>
