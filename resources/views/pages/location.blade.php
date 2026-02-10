@extends('main')

@section('title','Our Location')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Our Location</h1>
        <p class="text-muted">Find us easily on the map</p>
    </div>

    <div class="row align-items-center">
        <!-- Address Info -->
        <div class="col-md-5">
            <h4>Office Address</h4>
            <p><strong>Company Name:</strong> Cubbez Infotech Ambika Pinnacle, 230, </p>
            <p><strong>Address:</strong> nr. Lajamni Chowk Maruti Dham Society, Mota Varachha, Surat, Gujarat 394101</p>
            <p><strong>Phone:</strong> +91 98765 43210</p>
            <p><strong>Email:</strong> support@mycompany.com</p>

            <div class="mt-4">
                <h5>Working Hours</h5>
                <p>Mon - Fri: 9:00 AM - 6:00 PM</p>
                <p>Sat: 10:00 AM - 2:00 PM</p>
                <p>Sun: Closed</p>
            </div>
        </div>
        

        <!-- Google Map -->
        <div class="col-md-7">
            <div class="ratio ratio-16x9 shadow rounded">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.8381582603593!2d72.88527657600237!3d21.23826538054846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f3f47058ea5%3A0x9f00cac6cd71afad!2sCubiz%20Infotech!5e0!3m2!1sen!2sin!4v1770630290474!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection