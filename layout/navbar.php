<div class="collapse relative z-50 shadow-sm w-full rounded-none overflow-visible">
    <input id="navbar-1-toggle" class="peer hidden" type="checkbox">
    <label for="navbar-1-toggle" class="fixed inset-0 hidden max-lg:peer-checked:block"></label>
    <div class="navbar">
        <div class="navbar-start">
            <label for="navbar-1-toggle" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </label>
            <a class="btn btn-ghost text-xl" href="index.php">
                FakeGen
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="why.php">Why?</a></li>
                <li>
                    <details>
                        <summary>Generate</summary>
                        <ul class="w-30">
                            <li><a href="generate.php?type=name">Fake Names</a></li>
                            <li><a href="generate.php?type=email">Fake Emails</a></li>
                            <li><a href="generate.php?type=phone">Fake Phones</a></li>
                        </ul>
                    </details>
                </li>
                <li><a href="who.php">Who?</a></li>
            </ul>
        </div>
        <div class="navbar-end me-3">
            <a href="generate.php" class="btn btn-secondary">Generate Now!</a>
        </div>
    </div>

    <div class="collapse-content lg:hidden">
        <ul class="menu">
            <li><a href="why.php">Why?</a></li>
            <li>
                <a href="generate.php">Generate</a>
                <ul>
                    <li><a href="generate.php?type=name">Fake Names</a></li>
                    <li><a href="generate.php?type=email">Fake Emails</a></li>
                    <li><a href="generate.php?type=phone">Fake Phones</a></li>
                </ul>
            </li>
            <li><a href="who.php">Who?</a></li>
        </ul>
    </div>
</div>