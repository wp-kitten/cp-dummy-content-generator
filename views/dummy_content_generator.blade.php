@extends('admin.layouts.base')

@section('page-title')
    <title>{{__('cpdcg::m.Dummy Content Generator')}}</title>
@endsection

@section('main')

    <div class="app-title">
        <div class="cp-flex cp-flex--center cp-flex--space-between">
            <div>
                <h1>{{__('cpdcg::m.Content Generator')}}</h1>
            </div>
        </div>
    </div>

    @include('admin.partials.notices')

    @if(cp_current_user_can('manage_taxonomies'))
        <div class="tile">
            <div class="card-body">
                <h4 class="tile-title">{{__('cpdcg::m.Content')}}</h4>

                <p>{{__( 'cpdcg::m.You can use this page to create some dummy content to get you started.' )}}</p>
                <p>{{__( 'cpdcg::m.This content will consist of: categories, tags, posts, pages.' )}}</p>
                <form method="post"
                      class="form-dummy-content-generator"
                      action="{{route("admin.dummy_content_generator.generate")}}">

                    <div class="form-group">
                        <label for="pages">{{__( 'cpdcg::m.Pages' )}}</label>
                        <input type="number" id="pages" name="pages" step="1" min="0" max="100" value="10"/>
                    </div>
                    <div class="form-group">
                        <label for="pages">{{__( 'cpdcg::m.Posts' )}}</label>
                        <input type="number" id="posts" name="posts" step="1" min="0" max="100" value="10"/>
                    </div>
                    <div class="form-group">
                        <label for="pages">{{__( 'cpdcg::m.Categories' )}}</label>
                        <input type="number" id="categories" name="categories" step="1" min="0" max="100" value="10"/>
                    </div>
                    <div class="form-group">
                        <label for="pages">{{__( 'cpdcg::m.Tags' )}}</label>
                        <input type="number" id="tags" name="tags" step="1" min="0" max="100" value="10"/>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">{{__('cpdcg::m.Generate')}}</button>
                    @csrf
                </form>
            </div>
        </div>

    @endif
@endsection
