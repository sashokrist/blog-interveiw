@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">{{ __('About') }}</h3></div>
                    <div>
                        <a class="btn btn-primary" href="{{ route('home') }}">Back to home page</a>
                    </div>

                    <div class="card-body">
                        <p>Requirements:
                            Structure: Home Page, Blog Posts Page, Blog Post Single View Page, About Page, Contacts Page <span style="color:red; font-weight: bold">- DONE</span> <br>
                            User Authentication: Implement a user authentication system where users can register, login, and logout. <span style="color:red; font-weight: bold">- DONE</span> <br>
                            CRUD Operations: Users should be able to perform CRUD operations on blog posts. They should be able to create, read, update, and delete blog posts. <span style="color:red; font-weight: bold">- DONE</span>  <br>
                            The blog posts should have a title, content, publish date and an image. <span style="color:red; font-weight: bold">- DONE</span> <br>
                            Home Page should contain the last 10-12 published blog posts in reverse order (newest first). <span style="color:red; font-weight: bold">- DONE</span> <br>
                            The blog posts should be displayed in reverse order on the blog posts page with pagination. <span style="color:red; font-weight: bold">- DONE</span> <br>
                            The About page should contain short info about the project <span style="color:red; font-weight: bold">- DONE</span> <br>
                            The Contacts page should display short contact info for the creator/owner of the Blog <span style="color:red; font-weight: bold">- DONE</span> </p>
                        <hr>
                           <p> Bonus Tasks (optional):
                            Users should be able to find blog post through a search input in the blog header. <span style="color:red; font-weight: bold">- DONE</span> <br>
                            Blog posts should have categories: one blog post has one category and blog posts can be filtered by category in blog posts page <span style="color:red; font-weight: bold">- DONE</span> <br>
                            Commenting system: all users can comment on blog posts <span style="color:red; font-weight: bold">- DONE</span> <br>
                            Users can create blog post content through a WYSIWYG editor like TinyMCE or CKeditor <span style="color:red; font-weight: bold">- DONE</span> <br>
                            Unique likes for blog post: only for registered users - <span style="color:red; font-weight: bold">- NOT IMPLEMENTED</span> <br>
                            Contacts page has a contact form which sends emails to configured email in the .env file</p> <span style="color:red; font-weight: bold">- DONE</span> </p>
                        <hr>
                        <p>Profile page created showing logged user's posts. </p>
                        <p>
                            If you planing to install run php artisan db:seed --class=CategorySeeder to create categories.
                        </p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
