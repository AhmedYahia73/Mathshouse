@include('Visitor.inc.header')
@include('Visitor.inc.menu')

<style>
    .privacy-section {
        padding: 60px 20px;
        background-color: #fafafa;
    }

    .privacy-container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
        padding: 40px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .privacy-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #c30a0a;
        text-align: center;
    }

    .privacy-updated {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 30px;
        text-align: center;
    }

    .privacy-container h2 {
        font-size: 1.4rem;
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 600;
        color: #333;
    }

    .privacy-container p {
        line-height: 1.7;
        margin-bottom: 20px;
        color: #444;
    }

    .privacy-container ul {
        margin: 10px 0 20px 20px;
        padding-left: 20px;
    }

    .privacy-container li {
        margin-bottom: 10px;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .privacy-container {
            padding: 20px;
        }

        .privacy-title {
            font-size: 1.6rem;
        }
    }
</style>

<section class="privacy-section">
    <div class="privacy-container">
        <h1 class="privacy-title">Privacy Policy for Math House</h1>
        <p class="privacy-updated">Last Updated: September 15, 2025</p>

        <p>Welcome to Math House! This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website and mobile application (the "App"). Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the App.</p>

        <p>We reserve the right to make changes to this Privacy Policy at any time and for any reason. We will alert you about any changes by updating the “Last Updated” date of this Privacy Policy. You are encouraged to periodically review this Privacy Policy to stay informed of updates.</p>

        <h2>Collection of Your Information</h2>
        <p>We may collect information about you in a variety of ways. The information we may collect via the App depends on the content and materials you use, and includes:</p>

        <h2>Personal Data</h2>
        <ul>
            <li><b>Student Information:</b> first name, last name, email, password, optional profile photo, recovery email, phone.</li>
            <li><b>Parent/Guardian Information:</b> parent's email and phone.</li>
            <li><b>Payment Information:</b> payment details, proof of payment (e.g., Vodafone Cash receipt).</li>
        </ul>

        <h2>Usage and Performance Data</h2>
        <p>We track your progress, submissions, answers, and scores to provide feedback and improve our services.</p>

        <h2>Use of Your Information</h2>
        <ul>
            <li>Create and manage your account.</li>
            <li>Provide access to courses, lessons, quizzes, and exams.</li>
            <li>Track progress and performance.</li>
            <li>Process payments and refunds.</li>
            <li>Link with parent/guardian account.</li>
            <li>Send verification codes to confirm relationships.</li>
            <li>Communicate regarding account or services.</li>
            <li>Allow profile management and password reset.</li>
        </ul>

        <h2>Disclosure of Your Information</h2>
        <ul>
            <li><b>With Your Parent/Guardian:</b> performance data will be shared.</li>
            <li><b>By Law:</b> release info if required by legal process.</li>
            <li><b>Third-Party Providers:</b> payment processing, hosting, customer service.</li>
        </ul>
        <p>We will never sell your personal information to third parties.</p>

        <h2>Security of Your Information</h2>
        <p>We use administrative, technical, and physical measures to protect your data. However, no system is 100% secure. Please protect your credentials.</p>

        <h2>Your Rights and Choices</h2>
        <ul>
            <li>Review or change account info anytime.</li>
            <li>Logout at the end of sessions.</li>
            <li>Request account deletion by contacting us.</li>
        </ul>

        <h2>Children's Privacy</h2>
        <p>We require parental consent for child accounts. Parents may review or request deletion of child data by contacting us.</p>
        

        <h2>Fawry's Privacy</h2>
        <p>(“Fawry responsibility is limited to payment collection. For any related issue please contact us” ) .</p>
    </div>
</section>

@include('Visitor.inc.footer')
