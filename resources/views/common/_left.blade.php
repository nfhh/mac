<div class="list-group">
    @can('access-admin',Auth::user())
        <a href="{{ route('user.index') }}"
           class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'user.index') active @endif">用户管理</a>
        <a href="{{ route('upload.mac') }}"
           class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.mac') active @endif">
            上传MAC地址表
        </a>
        <a href="{{ route('upload.snkey') }}"
           class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.snkey') active @endif">上传SN&密钥表</a>
    @endcan
    <a href="{{ route('upload.pcba') }}"
       class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'upload.pcba') active @endif">上传MAC、SN
        & 密钥绑定表</a>

    @can('access-admin',Auth::user())
        <a href="{{ route('result.index') }}"
           class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'result.index') active @endif">PCBA绑定不良记录
        </a>
    @endcan

    <a href="{{ route('sn.index') }}"
       class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'sn.index') active @endif">PCBA入库SN检验
    </a>
    <a href="{{ route('sns.index') }}"
       class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'sns.index') active @endif">机身与彩盒SN比对</a>

        @can('access-admin',Auth::user())
            <a href="{{ route('product.index') }}"
               class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'product.index') active @endif">机种管理
            </a>
        @endcan

    <a href="{{ route('weight.index') }}"
       class="list-group-item list-group-item-action @if(Route::currentRouteName() === 'weight.index') active @endif">产品重量
    </a>
</div>
