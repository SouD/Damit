<?php
namespace Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Current request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = null;
        $key = 'locale';

        if (Auth::check()) {
            $locale = Auth::user()->locale;
        } else {
            // Negotiate a locale to use.
            $matches = $this->getAcceptLanguageHeaderMatches(
                $request->server('HTTP_ACCEPT_LANGUAGE'));
            $locale = $this->negotiateLanguageCode($matches->all(),
                config('app.locale', 'en'));
        }

        if ($locale) {
            App::setLocale($locale);
        }

        return $next($request);
    }

    /**
     * Get language and quality pairs from the accept language header.
     *
     * @see https://github.com/mcamara/laravel-localization/blob/master/src/Mcamara/LaravelLocalization/LanguageNegotiator.php#L100
     *
     * @param string $acceptLanguage Header
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAcceptLanguageHeaderMatches($acceptLanguage)
    {
        $matches = $genericMatches = [];
        $languages = explode(',', $acceptLanguage);

        foreach ($languages as $option) {
            $option = array_map('trim', explode(';', $option));
            $language = array_get($option, 0);
            $quality = null;

            if (isset($option[1])) {
                $quality = (float) str_replace('q=', '', array_get($option, 1));
            } else {
                if ('*/*' == $language) {
                    $quality = 0.01;
                } elseif ('*' == Str::substr($language, -1)) {
                    $quality = 0.02;
                }
            }

            $quality = !is_null($quality) ? $quality : 1000 - count($matches);
            $matches[$language] = $quality;
            $languageOptions = explode('-', $language);
            array_pop($languageOptions);

            while (!empty($languageOptions)) {
                $quality -= 0.001;
                $opt = implode('-', $languageOptions);

                if (empty($genericMatches[$opt]) || $genericMatches[$opt] > $quality) {
                    $genericMatches[$opt] = $quality;
                }

                array_pop($languageOptions);
            }
        }

        $matches = array_merge($genericMatches, $matches);

        arsort($matches, SORT_NUMERIC);

        return collect($matches);
    }

    /**
     * Get the best matching supported language code from an array of language quality pairs.
     *
     * @param array  $matches  Matches (language => quality)
     * @param string $fallback Fallback locale (Optional)
     *
     * @return string
     */
    public function negotiateLanguageCode(array $matches, string $fallback = 'en')
    {
        $matches = collect($matches);
        $supportedLanguages = $this->getAllCodes();

        foreach ($matches as $language => $quality) {
            // Check if the language match is directly supported.
            if ($supportedLanguages->contains($language)) {
                return $language;
            }

            foreach ($supportedLanguages as $supportedLanguage) {
                $supportedLower = Str::lower($supportedLanguage);
                $languageLower = Str::lower($language);

                if ($supportedLower == $languageLower) {
                    return $supportedLanguage;
                }

                if (Str::substr($supportedLower, 0, 2) == $languageLower) {
                    return $supportedLanguage;
                }
            }
        }

        // Check if wildcard is set, and return first supported language if so.
        if ($matches->contains('*')) {
            return $supportedLanguages->first();
        }

        return $fallback;
    }

    public function getAllCodes()
    {
        return collect(config('app.languages', []));
    }
}
