<div class="list-group">
    <a href="{{ route('upload.mac') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.mac') active @endif">
        上传MAC表
    </a>
    <a href="{{ route('upload.snkey') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.snkey') active @endif">上传SN&密钥表</a>
    <a href="{{ route('upload.pcba') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.pcba') active @endif">上传PCBA表</a>
    <a href="{{ route('result.index') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'result.index') active @endif">比对结果</a>
</div>
