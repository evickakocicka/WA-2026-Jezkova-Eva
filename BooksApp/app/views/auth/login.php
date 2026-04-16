<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-light tracking-widest text-pink-500 uppercase">Přihlášení</h2>
            <p class="text-pink-300 italic mt-2 text-sm">Vítejte zpět v naší Knihovně.</p>
        </div>

        <div class="bg-white border border-pink-200 rounded-xl shadow-2xl p-6 md:p-8">
            <form action="<?= BASE_URL ?>/index.php?url=auth/authenticate" method="post">

                <div class="space-y-6">
                    <div>
                        <label for="email" class="block text-xs font-semibold text-pink-400 mb-1 uppercase tracking-wider">E-mailová adresa</label>
                        <input type="email" id="email" name="email" required autofocus
                               class="w-full bg-pink-50 border border-pink-200 rounded-md px-4 py-2 text-pink-800 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 outline-none transition-all">
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold text-pink-400 mb-1 uppercase tracking-wider">Heslo</label>
                        <input type="password" id="password" name="password" required
                               class="w-full bg-pink-50 border border-pink-200 rounded-md px-4 py-2 text-pink-800 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 outline-none transition-all">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-4 rounded-md shadow-lg transition-all transform hover:scale-[1.01] active:scale-[0.99]">
                            Přihlásit se
                        </button>
                    </div>

                    <p class="text-center text-pink-400 text-sm border-t border-pink-100 pt-4">
                        Nemáte ještě účet? <a href="<?= BASE_URL ?>/index.php?url=auth/register" class="text-pink-600 hover:underline underline-offset-4 transition-colors font-medium">Zaregistrujte se</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>