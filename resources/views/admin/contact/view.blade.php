@extends('admin.admin_master')

@section('admin')




        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sent By: {{ $contacts['name'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-header">
                <p id="exampleModalLabel">Sender Email: {{ $contacts['email'] }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Sender Subject: {{ $contacts['subject'] }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                <p class="modal-body" id="exampleModalLabel">{{ $contacts['message'] }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-footer">
                <a href="{{ route('admin.message')}}" class="btn btn-info">Back</a>

            </div>
        </div>




@endsection

