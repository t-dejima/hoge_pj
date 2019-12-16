<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">{{ $modal_title }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body {{ !empty($modal_body_class) ? $modal_body_class : '' }}">{{ !empty($modal_body) ? $modal_body : '' }}</div>
    </div>
  </div>
</div>
