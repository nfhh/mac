<div class="list-group">
    <a href="{{ route('upload.mac') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.mac') active @endif">
        上传MAC表
    </a>
    <a href="{{ route('upload.snkey') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.snkey') active @endif">上传SN&密钥表</a>
    <a href="{{ route('upload.pcba') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.pcba') active @endif">上传PCBA表</a>
    <a href="{{ route('result.index') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'result.index') active @endif">比对结果</a>
    <a href="{{ route('sn.index') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'sn.index') active @endif">SN校验</a>
    <a href="{{ route('sns.index') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'sns.index') active @endif">机身与彩盒SN比对</a>
    <a href="{{ route('weight.index') }}" class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'weight.index') active @endif">称重与SN比对</a>
</div>
