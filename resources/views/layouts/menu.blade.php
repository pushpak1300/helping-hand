<li class="nav-item {{ Request::is('receivers*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('receivers.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Receivers</span>
    </a>
</li>
<li class="nav-item {{ Request::is('merchants*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('merchants.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Merchants</span>
    </a>
</li>
<li class="nav-item {{ Request::is('transactions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('transactions.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Transactions</span>
    </a>
</li>
