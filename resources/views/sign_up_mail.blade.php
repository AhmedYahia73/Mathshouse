<x-auth-layout>
    <h3>
        <img src="{{ public_path('assets/media/logos/Maths-house.png') }}" alt="">
        Welcome to Math House
        <br />
        To Confirm Your Email
        Click on Button.
    </h3>

    <h2>

        <form action="{{route('signup_confirm')}}" method="GET">
            <input type="hidden" name="email" value="{{ $email}}" />
            <input type="hidden" name="code" value="{{ $code}}" />
            <button class="btn btn-primary">
                Confirm
            </button>
        </form>
    </h2>
</x-auth-layout>