@component('components.custom_modal')
  @slot('modal_id', 'testModal')
  @slot('modal_title', 'test')
  @slot('modal_body_class', '')
  @slot('modal_body')
    {!! Form::open(['url' => 'test', 'method' => 'post', 'class' => 'text-center']) !!}
      {!! Form::hidden('id', $test->id) !!}
      {!! Form::button('SUBMIT',['type'=>'submit', 'name' => 'agree', 'class' => 'btn btn-success h4 px-5', 'value' => 'test']); !!}
      {!! Form::button('CLOSE',['type'=>'submit', 'class' => 'btn btn-secondary h4 ml-3 px-5', 'data-dismiss' => 'modal']); !!}
    {!! Form::close() !!}
  @endslot
@endcomponent