@extends('front.layouts.master')
@section('title', 'iletişim')
@section('bg', 'https://wallpapercave.com/wp/wp4863801.jpg')
@section('content')
<div class="col-md-10 col-lg-8 col-xl-7">
    <p>bizimle iletişime geçmek için iletişim formunu doldurup gönderebilirsiniz.</p>
    @if (session("success"))
    <div class="alert alert-success">
        {{session("success")}}
    </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="my-5">
        <form method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="form-floating">
                <input class="form-control" name="name" value="{{old("name")}}" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                <label for="name">ad soyad</label>
            </div>
            <div class="form-floating">
                <input class="form-control" name="email" value="{{old("email")}}" type="email" placeholder="email adresinizi giriniz" data-sb-validations="required,email" />
                <label for="email">email adresi</label>
            </div>
            <div class="form-floating">
                <select name="topic" class="form-control">
                    <option @if(old("topic")=="bilgi") selected @endif>bilgi</option>
                    <option @if(old("topic")=="destek") selected @endif>destek</option>
                    <option @if(old("topic")=="genel") selected @endif>genel</option>
                </select>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required">{{old("message")}}</textarea>
                <label for="message">mesajınız</label>
            </div>
            <br />
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center mb-3">
                    <div class="fw-bolder">Form submission successful!</div>
                    To activate this form, sign up at
                    <br />
                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
            <!-- Submit Button-->
            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>
        </form>
    </div>
</div>
@endsection