@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
<h1 class="page-title">
    <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

    @can('edit', $dataTypeContent)
    <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
        <span class="glyphicon glyphicon-pencil"></span>&nbsp;
        {{ __('voyager::generic.edit') }}
    </a>
    @endcan
    @can('delete', $dataTypeContent)
    @if($isSoftDeleted)
    <a href="{{ route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey()) }}" title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore" data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
    </a>
    @else
    <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
    </a>
    @endif
    @endcan

    <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
        <span class="glyphicon glyphicon-list"></span>&nbsp;
        {{ __('voyager::generic.return_to_list') }}
    </a>
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('content')
<div class="page-content read container-fluid">
    <div class="row">
        @if ($dataTypeContent->stades->count()>0)
            <div class="col-md-8">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    @foreach($dataType->readRows as $row)
                    @php
                    if ($dataTypeContent->{$row->field.'_read'}) {
                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                    }
                    @endphp
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">{{ $row->getTranslatedAttribute('display_name') }}</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        @if (isset($row->details->view))
                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                        @elseif($row->type == "image")
                        <img class="img-responsive" src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                        @elseif($row->type == 'multiple_images')
                        @if(json_decode($dataTypeContent->{$row->field}))
                        @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                        <img class="img-responsive" src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}">
                        @endforeach
                        @else
                        <img class="img-responsive" src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                        @endif
                        @elseif($row->type == 'relationship')
                        @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                        @elseif($row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
                        !empty($row->details->options->{$dataTypeContent->{$row->field}})
                        )
                        <?php echo $row->details->options->{$dataTypeContent->{$row->field}}; ?>
                        @elseif($row->type == 'select_multiple')
                            @if(property_exists($row->details, 'relationship'))

                                @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                {{ $item->{$row->field}  }}
                                @endforeach

                            @elseif(property_exists($row->details, 'options'))
                                @if (!empty(json_decode($dataTypeContent->{$row->field})))
                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                        @if (@$row->details->options->{$item})
                                            {{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                        @endif
                                    @endforeach
                                @else
                                {{ __('voyager::generic.none') }}
                                @endif
                            @endif
                        @elseif($row->type == 'date' || $row->type == 'timestamp')
                        @if ( property_exists($row->details, 'format') && !is_null($dataTypeContent->{$row->field}) )
                        {{ \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($row->details->format) }}
                        @else
                        {{ $dataTypeContent->{$row->field} }}
                        @endif
                        @elseif($row->type == 'checkbox')
                        @if(property_exists($row->details, 'on') && property_exists($row->details, 'off'))
                        @if($dataTypeContent->{$row->field})
                        <span class="label label-info">{{ $row->details->on }}</span>
                        @else
                        <span class="label label-primary">{{ $row->details->off }}</span>
                        @endif
                        @else
                        {{ $dataTypeContent->{$row->field} }}
                        @endif
                        @elseif($row->type == 'color')
                        <span class="badge badge-lg" style="background-color: {{ $dataTypeContent->{$row->field} }}">{{ $dataTypeContent->{$row->field} }}</span>
                        @elseif($row->type == 'coordinates')
                        @include('voyager::partials.coordinates')
                        @elseif($row->type == 'rich_text_box')
                        @include('voyager::multilingual.input-hidden-bread-read')
                        {!! $dataTypeContent->{$row->field} !!}
                        @elseif($row->type == 'file')
                        @if(json_decode($dataTypeContent->{$row->field}))
                        @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}">
                            {{ $file->original_name ?: '' }}
                        </a>
                        <br />
                        @endforeach
                        @else
                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($row->field) ?: '' }}">
                            {{ __('voyager::generic.download') }}
                        </a>
                        @endif
                        @else
                        @include('voyager::multilingual.input-hidden-bread-read')
                        <p>{{ $dataTypeContent->{$row->field} }}</p>
                        @endif
                    </div><!-- panel-body -->
                    @if(!$loop->last)
                    <hr style="margin:0;">
                    @endif
                    @endforeach

                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel panel-bordered panel-default">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title"><i class="voyager-milestone"></i>&nbsp;Stades</h3>
                    </div>
                    <div class="panel-body">
                        @foreach ( $dataTypeContent->stades as $stade)
                            <!-- stade -->
                            <div>    
                                @can('edit', $stade)
                                <a role="button"  data-toggle="modal" data-target="#stadeEditModal" data-stade="{{$stade->id}}" data-name="{{$stade->stade_name_id}}"data-date="{{$stade->date}}" data-state="{{$stade->state}}" data-observation="{{$stade->observation}}">
                                @endcan
                                <strong ><u class="text-truncate">{{ $stade->short}}</u>&nbsp;</strong>
                                @if($stade->state)
                                <span class="label label-info"> {{('Fini')}}</span>
                                @else
                                <span class="label label-warning"> {{('En-cours')}}</span>
                                @endif 
                                @can('edit', $stade)
                                <i class="glyphicon glyphicon-pencil pull-right"></i>&nbsp;
                                </a>
                                @endcan                                    
                            </div>
                            <!-- stade end-->
                            <div style="width:auto; height:auto; clear:both; display:block; padding:2px; margin:2px;">
                                <i class="voyager-calendar"> </i> <b> &nbsp; {{('Date')}}: {{ Carbon\Carbon::parse($stade->date)->format('d-m-Y') }}</b>
                            </div>    
                            <div style="width:auto; height:auto; clear:both; display:block; padding:2px; margin:2px;">
                                <i class="voyager-calendar"> </i> <b> &nbsp; {{('Date Limite')}}: {{ $stade->dead_line }}</b>
                            </div>    
                            <!-- attachement-->
                            @if(!is_null($stade->attachements))
                                <div style="width:auto; height:auto; clear:both;padding:2px; margin:2px;">
                                    <i class="voyager-paperclip"></i>&nbsp; {{('Pièces Jointes')}}<b>:</b>&nbsp;

                                    @can('add', $stade)                              
                                    <a role="button"  data-toggle="modal" data-target="#addModal" data-1="{{$dataTypeContent->getKey()}}" data-2="{{$stade->id}}">
                                        <i class="voyager-plus"></i>
                                    </a>
                                    @endcan  
                                </div>
                                <div class="container container-fluid">
                                    <div class="row">
                                        @foreach ( $stade->attachements as $attachement)
                                        @if(!empty($attachement->url))
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div>
                                                @can('edit', $attachement)
                                                <a role="button"  data-toggle="modal" data-target="#attachemenEditModal"
                                                data-lawsuit="{{$dataTypeContent->getKey()}}" data-stade="{{$stade->id}}" data-id="{{$attachement->id}}" data-name="{{$attachement->name}}">
                                                @endcan   
                                                    <strong >
                                                        <i class="voyager-documentation"> </i>  <u>{{ $attachement->name}}</u>&nbsp;
                                                    </strong>                                            
                                                @can('edit', $attachement)
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                @endcan
                                                @can('delete', $attachement)
                                                <a style="color:red;" role="button"  data-toggle="modal" data-target="#attachementDeleteModal" class="voyager-trash remove-single-file pull-right" data-id="{{ $attachement->id }}"></a>
                                                @endcan   
                                            </div>
                                            @if(isset($attachement->url))
                                                @if(json_decode($attachement->url) !== null)
                                                    @foreach(json_decode($attachement->url) as $file)
                                                        <div class="form-group" data-field-name="url">
                                                            <a class="col-xs-9 col-sm-9 col-md-9 text-truncate fileType" target="_blank"
                                                                href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ? str_replace('%5C', '/', Storage::disk(config('voyager.storage.disk'))->url($file->download_link)) : '' }}"
                                                                data-file-name="{{ $file->original_name ?: '' }}" data-id="{{$attachement->id}}">
                                                                <small>
                                                                    <i class="voyager-file-text"></i>
                                                                    {{ $file->original_name ?: '' }}
                                                                </small>
                                                            </a>
                                                            @can('edit', $attachement)
                                                            <a href="javascript:;" class="col-xs-3 col-sm-3 col-md-3 voyager-x remove-multi-file"></a>
                                                            @endcan
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group" data-field-name="url">
                                                        <a class="text-truncate fileType" target="_blank"
                                                            href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}"
                                                            data-file-name="{{ $file->original_name ?: '' }}" data-id="{{$attachement->id}}">
                                                            <small>
                                                                <i class="voyager-file-text"></i>
                                                                {{ $file->original_name ?: '' }}
                                                            </small>
                                                        </a>
                                                        @can('edit', $attachement)
                                                        <a href="javascript:;" class="pull right voyager-x remove-single-file"></a>
                                                        @endcan
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <!-- attachementfin-->
                            <hr> 
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    @foreach($dataType->readRows as $row)
                    @php
                    if ($dataTypeContent->{$row->field.'_read'}) {
                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                    }
                    @endphp
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">{{ $row->getTranslatedAttribute('display_name') }}</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                        @if (isset($row->details->view))
                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                        @elseif($row->type == "image")
                        <img class="img-responsive" src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                        @elseif($row->type == 'multiple_images')
                        @if(json_decode($dataTypeContent->{$row->field}))
                        @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                        <img class="img-responsive" src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}">
                        @endforeach
                        @else
                        <img class="img-responsive" src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                        @endif
                        @elseif($row->type == 'relationship')
                        @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                        @elseif($row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
                        !empty($row->details->options->{$dataTypeContent->{$row->field}})
                        )
                        <?php echo $row->details->options->{$dataTypeContent->{$row->field}}; ?>
                        @elseif($row->type == 'select_multiple')
                            @if(property_exists($row->details, 'relationship'))

                                @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                {{ $item->{$row->field}  }}
                                @endforeach

                            @elseif(property_exists($row->details, 'options'))
                                @if (!empty(json_decode($dataTypeContent->{$row->field})))
                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                        @if (@$row->details->options->{$item})
                                            {{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                        @endif
                                    @endforeach
                                @else
                                {{ __('voyager::generic.none') }}
                                @endif
                            @endif
                        @elseif($row->type == 'date' || $row->type == 'timestamp')
                        @if ( property_exists($row->details, 'format') && !is_null($dataTypeContent->{$row->field}) )
                        {{ \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($row->details->format) }}
                        @else
                        {{ $dataTypeContent->{$row->field} }}
                        @endif
                        @elseif($row->type == 'checkbox')
                        @if(property_exists($row->details, 'on') && property_exists($row->details, 'off'))
                        @if($dataTypeContent->{$row->field})
                        <span class="label label-info">{{ $row->details->on }}</span>
                        @else
                        <span class="label label-primary">{{ $row->details->off }}</span>
                        @endif
                        @else
                        {{ $dataTypeContent->{$row->field} }}
                        @endif
                        @elseif($row->type == 'color')
                        <span class="badge badge-lg" style="background-color: {{ $dataTypeContent->{$row->field} }}">{{ $dataTypeContent->{$row->field} }}</span>
                        @elseif($row->type == 'coordinates')
                        @include('voyager::partials.coordinates')
                        @elseif($row->type == 'rich_text_box')
                        @include('voyager::multilingual.input-hidden-bread-read')
                        {!! $dataTypeContent->{$row->field} !!}
                        @elseif($row->type == 'file')
                        @if(json_decode($dataTypeContent->{$row->field}))
                        @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}">
                            {{ $file->original_name ?: '' }}
                        </a>
                        <br />
                        @endforeach
                        @else
                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($row->field) ?: '' }}">
                            {{ __('voyager::generic.download') }}
                        </a>
                        @endif
                        @else
                        @include('voyager::multilingual.input-hidden-bread-read')
                        <p>{{ $dataTypeContent->{$row->field} }}</p>
                        @endif
                    </div><!-- panel-body -->
                    @if(!$loop->last)
                    <hr style="margin:0;">
                    @endif
                    @endforeach

                </div>
            </div>

        @endif
    </div>


</div>

<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
            </div>
            <div class="modal-footer">
                <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                </form>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@can('add', $dataTypeContent)

<div class="modal modal-success fade" tabindex="-1" id="addModal" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="addModalLabel"><i class="voyager-plus"></i>&nbsp;{{ __('Ajouter Pièces Jointes') }}</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('voyager.pieces-jointes.store') }}" id="add_form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Titre</label>
                        <input type="text" class="form-control" id="recipient-name" name="name" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="recipient-value" class="control-label">Documents</label>
                        <input type="file" id="recipient-value" name="url[]" multiple="multiple">
                    </div>
                    <input type="hidden"  id="r1" name="lawsuit_id">
                    <input type="hidden"  id="r2" name="stade_id">
                    
            </div>
            <div class="modal-footer">
                    <input type="submit" class="btn btn-success pull-right delete-confirm" value="{{ __('Ajouter') }}">
                </form>
                <!-- </form> -->
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endcan
@can('edit', $dataTypeContent)

<div class="modal modal-info fade" tabindex="-1" id="attachemenEditModal" role="dialog" aria-labelledby="attachemenEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="attachemenEditLabel"><i class="glyphicon glyphicon-pencil pull-left"></i>&nbsp;{{ __('Editer Pièce Jointe') }}</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="attachementEditForm" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <input type="hidden"id="lawsuit" name="lawsuit_id">
                    <input type="hidden"id="stade" name="stade_id">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Titre</label>
                        <input id="attachementName" type="text" class="form-control" name="name" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="recipient-value" class="control-label">Documents</label>
                        <input  type="file" name="url[]" multiple="multiple">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn pull-right btn-primary save">{{ __('voyager::generic.save') }}</button>
                </form>
                <!-- </form> -->
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal modal-info fade" tabindex="-1" id="stadeEditModal" role="dialog" aria-labelledby="stadeEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="stadeEditModalLabel"><i class="glyphicon glyphicon-pencil pull-left"></i>&nbsp;{{ __('Editer Stade') }}</h4>
            </div>
            <div class="modal-body">
            <form role="form" id="stadeEditForm" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <input type="hidden" name="lawsuit_id" value="{{$dataTypeContent->getKey()}}">
                    <input id="stadeName" type="hidden" name="stade_name_id">
                    <div class="form-group"><!-- date -->
                        <label class="control-label" for="date">Date</label>
                        <input id="stadeDate" type="date" class="form-control" name="date" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="state">État</label>
                        <br>
                        <input id="stadeStateOn" type="checkbox"  name="state">
                        <span class="label label-info">{{__('Fini')}}</span></br>
                    </div>
                    <div class="form-group"><!-- observation -->
                        <label class="control-label" for="observation">Observation</label>
                        <textarea id="stadeObservation" class="form-control" name="observation" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="stadeEdit"  type="submit" class="btn btn-info pull-right delete-confirm" value="{{ __('voyager::generic.save') }}">
            </form>
                <!-- </form> -->
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endcan
@can('delete', $dataTypeContent)
{{-- File delete modal --}}
<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-danger fade" tabindex="-1" id="attachementDeleteModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ __('Pièce Jointe') }}?</h4>
            </div>
            <div class="modal-footer">
                <form id="attachementDeleteForm" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }} {{ __('Pièce Jointe') }}">
                </form>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endcan
<!-- End Delete File Modal -->
@stop

@section('javascript')
@if ($isModelTranslatable)
<script>
    $(document).ready(function() {
        $('.side-body').multilingual();
    });
</script>
@endif
<script>

    var deleteFormAction;
    var params = {};
    var $file;
    
    function deleteHandler(tag, isMulti) {
        return function() {
        $file = $(this).siblings(tag);

        params = {
            slug:   'pieces-jointes',
            filename:  $file.data('file-name'),
            id:     $file.data('id'),
            field:  $file.parent().data('field-name'),
            multi: isMulti,
            _token: '{{ csrf_token() }}'
        }

        $('.confirm_delete_name').text(params.filename);
        $('#confirm_delete_modal').modal('show');
        };
    }

    $('.delete').on('click', function(e) {
        var form = $('#delete_form')[0];

        if (!deleteFormAction) {
            // Save form action initial value
            deleteFormAction = form.action;
        }

        form.action = deleteFormAction.match(/\/[0-9]+$/) ?
            deleteFormAction.replace(/([0-9]+$)/, $(this).data('id')) :
            deleteFormAction + '/' + $(this).data('id');

        $('#delete_modal').modal('show');
    });

    $('#addModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var r1 = button.data('1')
        var r2 = button.data('2')
        var modal = $(this)
        // modal.find('.modal-title').text('Ajouter des Pièces Jointes ')
        modal.find('#r1').val(r1)
        modal.find('#r2').val(r2)
    });
    $('#attachemenEditModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var lawsuit = button.data('lawsuit')
        var stade = button.data('stade')
        var id = button.data('id')
        var action = "{{url('/')}}" + "/vvci/pieces-jointes/" + id
        var name = button.data('name')
        var modal = $(this)
        modal.find('#attachementEditForm').attr('action', action);
        modal.find('#lawsuit').val(lawsuit);
        modal.find('#stade').val(stade);
        modal.find('#attachementName').val(name);
    });
    $('#attachementDeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var action = "{{url('/')}}" + "/vvci/pieces-jointes/" + id
        var modal = $(this)
        modal.find('#attachementDeleteForm').attr('action', action);
    });
    $('#stadeEditModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var stade = button.data('stade')
        var action = "{{url('/')}}" + "/vvci/stades/" + stade
        var stadeName = button.data('name')
        var stadeDate = button.data('date')
        var stadeState = button.data('state')
        var stadeObservation = button.data('observation')
        var modal = $(this)
        modal.find('#stadeEditForm').attr('action', action);
        modal.find('#stadeName').val(stadeName);
        modal.find('#stadeDate').val(stadeDate);
        modal.find('#stadeObservation').val(stadeObservation);
        if (stadeState == 1) {
            document.getElementById("stadeStateOn").checked = true;
        } else {
            document.getElementById("stadeStateOn").checked = false;
        }
    });
    $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
    $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));
    $('#confirm_delete').on('click', function(){
        $.post('{{ route("voyager.pieces-jointes.media.remove") }}', params, function (response) {
            if ( response
                && response.data
                && response.data.status
                && response.data.status == 200 ) {

                toastr.success(response.data.message);
                $file.parent().fadeOut(300, function() { $(this).remove(); })
            } else {
                toastr.error("Error removing file.");
            }
        });

        $('#confirm_delete_modal').modal('hide');
    });

</script>
@if(Session::has('message'))
    <script>
        toastr.{!!Session::get('alert-type')!!}("{!! Session::get('message') !!}");
    </script>
@endif
@if(Session::has('message_added'))
    <script>
        toastr.{!!Session::get('alert-type')!!}("{!! Session::get('message_added') !!}");
    </script>
@endif
@if(Session::has('message_billing_added'))
    <script>
        toastr.{!!Session::get('alert-type')!!}("{!! Session::get('message_billing_added') !!}");
    </script>
@endif
@stop