# Plan for LTS 2026

Bas: `2.0.18`. Nuvarande LTS-head: `b766e8b7`. Ny upstream-bas: `3.1.4`.

## Slutsats

Upstream `3.1.4` innehåller stora förbättringar men kräver
`helsingborg-stad/municipio`. LTS-arbetet behöver därför lösa
Composer-kompatibilitet och avgöra vilka publika filter/hooks som är kontrakt.

## Arbetsplan

- [ ] Starta från upstream `3.1.4`.
- [ ] Lös Composerkompatibilitet för `helsingborg-stad/municipio`.
- [ ] Återskapa LTS-paketering utan att ta bort upstreamkrav som används.
- [ ] Återskapa hero- och felhooks som små adapterlager.
- [ ] Funktionstesta bildimport med externa event som har featured image.
- [ ] Verifiera om upstreams formrefaktor täcker LTS-flödena.

## Beslutstabell

| Område | Vår slutändring | Upstream-läge | Bedömning | Berörda commits |
| --- | --- | --- | --- | --- |
| Composer och paketering | Bytte paketnamn, GPL och installer-metadata samt tog bort vissa upstreamkrav. | Upstream kräver `helsingborg-stad/municipio`, `acf-export-manager` och `json-schema`. | Återskapa smalare, behåll upstreamkrav där de används | package-/basecommits |
| Municipio-beroende | LTS hade ingen explicit `helsingborg-stad/municipio`-koppling. | `3.1.4` kräver upstreamtemat. | Verifiera manuellt via Composer `replace` i LTS-temat eller metapaketet | upstreamkrav i `3.1.4` |
| Hero-filter | Lade till `EventManagerIntegration/DisableEventHero` och `DisableEventHeroOverlay`. | Upstream har `cleanHero`, men inte samma publika filter eller full hero-disable. | Återskapa smalare | `9efadfe0` |
| API-felhook och debuglogg | Lade till `ApiEventManagerIntegration/requestApiError` och debuglogg. | Hittades inte i `3.1.4`. | Behåll om driftövervakning använder hooken | `d1f9f163`, `577efe83`, `fabbb9d3` |
| Bildimport | Sparade slug från API och genererade attachment metadata. | Upstream har omarbetad post object-/importyta, men samma beteende behöver verifieras. | Verifiera manuellt | `2a3d02a1`, `8a1ee1a7` |
| Formulär och datalist | Lade till ny eventform och flera submitfixar. | Upstream har en större formrefaktor och React-kod har förändrats/försvunnit. | Ersätt med upstream, verifiera kundspecifikt beteende | `81ddc285` och formcommits |
| Tillgänglighet och kortkontext | Rensade ogiltig ARIA och lade context till sidebar cards. | Upstream har bredare markupförändringar. | Ersätt | a11y-/contextcommits |
| Byggsystem/assets | Byte till pnpm och byggartefakter. | Ska hanteras av upstream och lokala byggsteg. | Ej relevant | `90a4cf3c` och assetcommits |

## Risker att verifiera

- `helsingborg-stad/municipio` kan kräva `replace` från LTS-temat eller
  metapaketet.
- Bildimport måste skapa thumbnails/metadata och använda stabil filslug.
- Om nya översättningssträngar införs senare måste språkfiler uppdateras
  manuellt med `wp i18n` och Poedit.

## Analyskommandon

- `git diff --stat 2.0.18..HEAD`
- `git diff --stat 2.0.18..3.1.4`
- `git diff --stat HEAD..3.1.4`
- `git log --reverse --format='%h%x09%ad%x09%s' --date=short 2.0.18..HEAD`
- `git log --reverse --format='%h%x09%ad%x09%s' --date=short 2.0.18..3.1.4`
- Riktade `git diff`, `git show` och `git grep` för Composer, parser,
  event-views, post manager, API-objekt, formkod och hooks.
