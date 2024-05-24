@extends('client.layouts.masterlayout')
@section('content')
<div class="container-xxl py-5 bg-danger hero-header mb-5">
    <div class="container my-5 py-5 px-lg-5">
        <div class="row g-5 pt-5">
            <div class="col-12 text-center text-lg-start">
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-12 wow fadeInUp">
                <div class="section-title position-relative mb-4 pb-4">
                    <h1 class="mb-2">Welcome to Fast Move Logistics Ltd</h1>
                </div>
                <h3>Be Your Own Boss & Earn Extra Cash with FastMoveBD.com 
                    Deliveries!</h3>
                
                <p><b>Looking for a flexible way to boost your income?</b> FastMoveBD.com offers the perfect 
                    opportunity to <b>be your own boss</b> and <b>earn extra cash</b> on your terms.</p>

                <h5>Here's why FastMove.com is the perfect delivery partner for you:</h5>
                <ul>
                    <li><h5> Set Your Own Schedule:</h5><b>Total flexibility</b> is at the heart of what we offer. Choose the 
                        <b>days you want to work</b> and <b>select the deliveries</b> that fit your schedule. Whether you 
                        want a side hustle or a full-time gig, FastMoveBD.com lets you work as much or as little as 
                        you choose.</li>
                    <li><h5>Become Your Own Boss:</h5> Ditch the 9-to-5 grind and take charge of your work life. 
                        With FastMoveBD.com, you're the captain of your ship. Decide when and where you work, 
                        and enjoy the freedom of being your own boss.</li>
                    <li><h5>Boost Your Income:</h5> Every delivery you complete adds to your earnings. <b>Earn extra 
                        income </b>on top of your regular job or make FastMoveBD.com your primary source of income 
                        - the choice is yours!
                        </li>
                </ul>
                <p><b>Ready to unlock a flexible and rewarding career path?</b> Sign up to become a FastMoveBD.com 
                    delivery partner today!</p>

                <br>
                <h3>Exclusive FastMoveBD.com Perks: Supercharge Your Earnings 
                    & Shine Brighter!</h3>
                <p>FastMoveBD.com isn't just about delivering packages; it's about <b>unlocking a world of exclusive 
                    benefits</b> designed to maximize your earnings and reward your dedication. Here's what sets 
                    FastMove.com apart:</p>

                <ul>
                    <li><h5> Mission Bonus:</h5> Go the extra mile (literally!) and get rewarded for it! Our <b>Mission 
                        Bonus program</b> grants you <b>bonus earnings</b> on top of your base delivery rate for 
                        completing orders and consistently maintaining a <b>high driver rating</b>. The better you 
                        perform, the more you earn!
                        </li>
                    <li><h5>Vehicle Sticker Advantage:</h5> Show your FastMove.com pride and get rewarded for it! 
                        When you proudly display our <b>exclusive vehicle sticker</b>, you'll unlock additional earning 
                        opportunities. We can't reveal all our secrets here, but let's just say your dedication to 
                        FastMove.com will be handsomely recognized.</li>
                </ul>

                <p><b>FastMoveBD.com goes beyond just deliveries. We invest in our partners.</b> With our exclusive 
                    benefits program, you'll enjoy a rewarding career path with the flexibility and earning potential 
                    you deserve</p>
                <h5>Ready to experience the FastMove.com difference? Sign up today!</h5>
                
                <div>
                    <button class="btn-grp orange-color justify-content-between">
                        <a class="text-decoration-none text-white" href="{{route('pickupman.register')}}">Sign Up as a Pickupman</a>
                    </button>
                    <button class="btn-grp orange-color justify-content-between">
                        <a class="text-decoration-none text-white" href="{{route('deliveryman.register')}}">Sign Up as a Deliveryman</a>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection