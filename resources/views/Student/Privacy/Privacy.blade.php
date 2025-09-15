@include('Visitor.inc.header')
@include('Visitor.inc.menu')

  <style>
    :root{
      --bg:#0f1724; /* dark navy */
      --card:#0b1220;
      --muted:#9aa6b2;
      --accent:#7c3aed; /* violet */
      --glass: rgba(255,255,255,0.03);
      --maxwidth:900px;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      color-scheme: light dark;
    }
    /* Reset-ish */
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background: linear-gradient(180deg,var(--bg),#071025);
      color:#e6eef6;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      padding:48px 20px;
      display:flex;
      align-items:flex-start;
      justify-content:center;
      line-height:1.6;
    }
    .container{
      width:100%;
      max-width:var(--maxwidth);
    }
    header{display:flex;align-items:center;gap:16px;margin-bottom:20px}
    .logo{
      width:64px;height:64px;border-radius:12px;background:linear-gradient(135deg,var(--accent),#4f46e5);display:grid;place-items:center;font-weight:700;font-size:20px;color:white;box-shadow:0 6px 18px rgba(10,10,30,0.6)
    }
    h1{font-size:20px;margin:0}
    .meta{color:var(--muted);font-size:13px}

    main{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-radius:14px;padding:26px;border:1px solid rgba(255,255,255,0.03);backdrop-filter:blur(6px);
      box-shadow:0 8px 30px rgba(2,6,23,0.7);
    }

    nav.topnav{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:18px}
    nav a{font-size:13px;color:var(--muted);text-decoration:none;padding:8px 10px;border-radius:8px}
    nav a:hover{background:var(--glass);color:var(--accent)}

    section{margin-bottom:18px}
    section h2{margin:0 0 8px 0;font-size:16px}
    .lead{color:var(--muted);font-size:14px;margin-bottom:12px}

    .card{background:linear-gradient(180deg, rgba(255,255,255,0.015), transparent);padding:16px;border-radius:10px;border:1px solid rgba(255,255,255,0.02)}

    dl{display:grid;gap:8px}
    dt{font-weight:600}
    dd{margin:4px 0 12px 0;color:var(--muted)}

    .small{font-size:13px;color:var(--muted)}

    /* sidebar style for quick links on wide screens */
    .layout{display:grid;grid-template-columns:1fr;gap:18px}

    @media(min-width:900px){
      .layout{grid-template-columns:260px 1fr}
      aside{position:sticky;top:28px;height:fit-content}
    }

    aside .box{background:transparent;padding:12px;border-radius:10px}
    .toc{display:flex;flex-direction:column;gap:6px}
    .toc a{color:var(--muted);text-decoration:none;font-size:14px;padding:6px;border-radius:8px}
    .toc a:hover{background:var(--glass);color:var(--accent)}

    /* FAQ style toggles for sections */
    .toggle{border-radius:8px;padding:12px;background:rgba(255,255,255,0.01);border:1px solid rgba(255,255,255,0.02);cursor:pointer;display:flex;align-items:center;justify-content:space-between}
    .toggle h3{margin:0;font-size:15px}
    .toggle p{margin:8px 0 0 0;color:var(--muted)}
    details{margin-top:8px}

    footer{display:flex;gap:12px;align-items:center;justify-content:space-between;margin-top:18px}
    .btn{display:inline-block;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:600}
    .btn.accent{background:linear-gradient(90deg,var(--accent),#4f46e5);color:white}
    .btn.ghost{border:1px solid rgba(255,255,255,0.04);color:var(--muted);background:transparent}

    /* print styles */
    @media print{
      body{background:white;color:black;padding:0}
      main{box-shadow:none;border:none;background:transparent}
      nav,aside,footer{display:none}
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="logo">MH</div>
      <div>
        <h1>Privacy Policy — Math House</h1>
        <div class="meta">Last Updated: <time datetime="2025-09-15">September 15, 2025</time></div>
      </div>
    </header>

    <main>
      <div class="layout">
        <aside>
          <div class="box card">
            <strong>On this page</strong>
            <nav class="toc" aria-label="Table of contents">
              <a href="#collection">Collection of Your Information</a>
              <a href="#use">Use of Your Information</a>
              <a href="#disclosure">Disclosure of Your Information</a>
              <a href="#security">Security</a>
              <a href="#rights">Your Rights & Choices</a>
              <a href="#children">Children's Privacy</a>
              <a href="#contact">Contact</a>
            </nav>
          </div>
          <div class="box small" style="margin-top:10px">Designed for readability — print friendly.</div>
        </aside>

        <section>
          <p class="lead">Welcome to <strong>Math House</strong>. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website and mobile application (the "App"). If you do not agree with this policy, please do not access the App.</p>

          <section id="collection" class="card" aria-labelledby="collection-title">
            <h2 id="collection-title">Collection of Your Information</h2>
            <p class="small">We may collect information about you in a variety of ways. The information we collect depends on the parts of the App you use and may include:</p>

            <dl>
              <dt>Personal Data</dt>
              <dd>
                <strong>Student Information:</strong> First name, last name, email address, password. Optionally: profile photo, recovery email, phone number.<br>
                <strong>Parent/Guardian Information:</strong> Parent email and phone number to link accounts.<br>
                <strong>Payment Information:</strong> Payment details to process purchases. For some payment methods we may request proof of payment (e.g., a receipt image that may contain a Vodafone Cash number or similar).</dd>

              <dt>Usage and Performance Data</dt>
              <dd>Progress, submissions, answers, quiz/exam scores and related performance metrics used to provide feedback and improve the service.</dd>
            </dl>
          </section>

          <section id="use" style="margin-top:14px" class="card" aria-labelledby="use-title">
            <h2 id="use-title">Use of Your Information</h2>
            <p class="small">We use information to provide and improve our services. Examples include:</p>
            <ul>
              <li>Create and manage your account.</li>
              <li>Provide access to courses, lessons, quizzes, and exams.</li>
              <li>Track your performance and progress.</li>
              <li>Process payments and refunds.</li>
              <li>Link student and parent/guardian accounts and verify the relationship via a verification code sent by email.</li>
              <li>Communicate about your account and preferences.</li>
              <li>Enable password resets and profile management.</li>
            </ul>
          </section>

          <section id="disclosure" style="margin-top:14px" class="card" aria-labelledby="disclosure-title">
            <h2 id="disclosure-title">Disclosure of Your Information</h2>
            <p class="small">We will not sell your personal information. We only share data in limited circumstances:</p>
            <ul>
              <li><strong>With Your Parent/Guardian:</strong> When accounts are linked, performance data and results are shared with the parent/guardian.</li>
              <li><strong>By Law or to Protect Rights:</strong> If required to respond to legal process or to protect rights, property, safety, or to investigate policy violations.</li>
              <li><strong>Third-Party Service Providers:</strong> Payment processors, email delivery, hosting, analytics, and customer service providers who are contractually required to protect your information.</li>
            </ul>
          </section>

          <section id="security" style="margin-top:14px" class="card" aria-labelledby="security-title">
            <h2 id="security-title">Security of Your Information</h2>
            <p class="small">We use administrative, technical, and physical measures to protect your information, but no security is perfect. Information sent online may be vulnerable to interception. We cannot guarantee absolute security.</p>
            <p class="small">For convenience and security you may view the password you are typing when logging in and change your password at any time through account settings.</p>
          </section>

          <section id="rights" style="margin-top:14px" class="card" aria-labelledby="rights-title">
            <h2 id="rights-title">Your Rights and Choices</h2>
            <p class="small">Manage your account and data:</p>
            <ul>
              <li><strong>Account Information:</strong> Review or change account details via account settings.</li>
              <li><strong>Logout:</strong> Log out at the end of sessions.</li>
              <li><strong>Account Deletion:</strong> Request account deletion by contacting our support (see Contact section). We will deactivate or delete your account from active systems, though some records may be retained for fraud prevention, troubleshooting, legal compliance, or to enforce our Terms of Use.</li>
            </ul>
          </section>

          <section id="children" style="margin-top:14px" class="card" aria-labelledby="children-title">
            <h2 id="children-title">Children's Privacy</h2>
            <p class="small">Our services are designed for students of all ages. We are committed to protecting children's privacy. We obtain parental consent for collecting, using, and disclosing a child's personal information through the parent-student account linking process (a verification code will be used to confirm the parent).</p>
            <p class="small">Parents/guardians may review their child's information, request deletion, or refuse further collection or use by contacting us (see Contact).</p>
          </section>

          <section id="contact" style="margin-top:14px" class="card" aria-labelledby="contact-title">
            <h2 id="contact-title">Contact</h2>
            <p class="small">If you have questions or wish to request data deletion or updates, please contact us at: <br><strong>support@mathhouse.example</strong></p>
          </section>

          <footer>
            <div class="small">&copy; Math House — Privacy Policy</div>
            <div>
              <a class="btn ghost" href="#" onclick="window.print();return false">Print</a>
              <a class="btn accent" href="mailto:support@mathhouse.example">Contact Support</a>
            </div>
          </footer>
        </section>
      </div>
    </main>
  </div>

  <script>
    // Smooth scroll for TOC links
    document.querySelectorAll('a[href^="#"]').forEach(a=>{
      a.addEventListener('click',function(e){
        const href = this.getAttribute('href');
        if(href.startsWith('#')){
          e.preventDefault();
          const el = document.querySelector(href);
          if(el) el.scrollIntoView({behavior:'smooth',block:'start'});
        }
      })
    })
  </script> 


@include('Visitor.inc.footer')
