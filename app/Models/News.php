<?php

namespace App\Models;

class News
{
    private array $news = [
        [
            'id' => 1,
            'title' => 'На нацпроект "Наука и университеты" направят 145 миллиардов рублей',
            'text' => 'МОСКВА, 22 сен - РИА Новости. Власти РФ планируют направить на нацпроект "Наука и университеты" 145 миллиардов рублей в 2023 году, 155 миллиардов рублей - в 2024 годах, сообщается в документе, который имеется в распоряжении РИА Новости.
"Бюджетные ассигнования на финансовое обеспечение реализации национального проекта "Наука и университеты" запланированы в 2023 году в объеме 144 824,6 миллиона рублей, в 2024 году - 154 744,5 миллиона рублей," - говорится в документе.',
            'category_id' => 1,
        ],
        [
            'id' => 2,
            'title' => 'Саудовская Аравия планирует отправить в космос первый национальный экипаж',
            'text' => 'ДОХА, 22 сен - РИА Новости. Саудовская Аравия начинает подготовку для отправки в космос в 2023 году первого национального экипажа, куда войдет саудовская женщина-космонавт, сообщило в четверг Саудовское агентство новостей со ссылкой на Космическое управление королевства.
"Королевство начинает программу подготовки национального экипажа космонавтов, цель которой - подготовить национальные кадры для отправки в космос на короткий и долгий сроки, а также для участия в научных экспериментах, международных исследованиях и независимых миссиях. Программа предусматривает отправку в космос смешанных саудовских экипажей. Первый полет с участием саудовского экипажа, куда войдет и жещина-космонавт, состоится в 2023 году", - говорится в сообщении.
Королевство объявит о национальной стратегии по освоению космоса в ближайшие месяцы.',
            'category_id' => 1,
        ],
        [
            'id' => 3,
            'title' => 'Прививка от старения. Биологи открыли новый механизм продления жизни',
            'text' => 'Старение — биологический процесс, который приводит к постепенному нарушению, а иногда и утрате важных функций организма. В свое время группа европейских ученых провела масштабный анализ литературы и опубликовала в журнале Cell обзорную статью. Авторы выделили девять "признаков" старения. Хотя речь скорее о его причинах, и каждая из них связана с тем или иным молекулярным механизмом. Если кратко, все так или иначе сводится к накоплению клеточных повреждений.
Первая причина — геномная нестабильность. Генетический код — инструкция для развития клеток. Когда они делятся, а ДНК реплицируется, в частях кода неизбежно возникают сбои. Чем старше ткани, тем больше накопленных ошибок, приводящих к гибели клеток или перерождению в злокачественные. Для замедления этого процесса нужно усовершенствовать механизм восстановления ДНК — или хотя бы научиться оперативно удалять поврежденные клетки.
Вторая причина — истощение теломер, "защитных колпачков" на концах хромосом, содержащих клеточные ДНК. При каждом делении длина теломер уменьшается. В конечном итоге хромосома разрушается и клетка погибает.',
            'category_id' => 1,
        ],
        [
            'id' => 4,
            'title' => '"Спартак" назначил Пола Эшуорта спортивным директором',
            'text' => 'В сезоне-2004/05 Эшуорт занимал аналогичную должность в "Ростове". В двух матчах он принял участие в качестве исполняющего обязанности главного тренера вместо проходившего курс лечения Геннадия Степушкина. В прошедшем сезоне работал техническим директором в английском "Брайтоне". Отмечается, что Эшуорт знает русский язык.
Ранее "Лукойл" приобрел 100% акций "Спартака". Владевший клубом с 2004 года Леонид Федун сложил с себя полномочия президента, члена и председателя совета директоров. В июле пост спортивного директора "Спартака" покинул итальянец Лука Каттани.',
            'category_id' => 2,
        ],
        [
            'id' => 5,
            'title' => 'Мешков рассудит "Спартак" и "Зенит" в матче Кубка России по футболу',
            'text' => 'МОСКВА, 26 сен - РИА Новости. Судейская бригада во главе с Виталием Мешковым обслужит матч московского "Спартака" и санкт-петербургского "Зенита" в третьем туре группового этапа Кубка России, сообщается на официальном сайте Российского футбольного союза (РФС).
Помогать Мешкову будут ассистенты Максим Гаврилин и Александр Богданов, резервный судья - Сергей Чебан. За систему видеоассистента рефери (VAR) будут отвечать Евгений Кукуляк и Игорь Демешко.
Встреча между "Спартаком" и "Зенитом" пройдет 29 сентября в Москве и начнется в 20:30 мск.',
            'category_id' => 2,
        ],
        [
            'id' => 6,
            'title' => 'В СБР сообщили о возможном переносе Финала Кубка России по биатлону из Сочи',
            'text' => 'МОСКВА, 26 сен - РИА Новости. Финал Кубка России, который должен был пройти с 9 по 15 февраля в Сочи, скорее всего, будет перенесен в другое место, сообщил в своем Telegram-канале руководитель пресс-службы Союза биатлонистов России (СБР) Сергей Аверьянов.',
            'category_id' => 2,
        ],
        [
            'id' => 7,
            'title' => 'Фильм "Красная Шапочка" возглавил прокат в России и СНГ за прошедший уикенд',
            'text' => 'МОСКВА, 26 сен – РИА Новости. Фильм режиссеров Лины Арифулиной, Александра Баршака, Артема Аксененко "Красная Шапочка" возглавил прокат в России и СНГ за прошедшие выходные со сборами 47 миллионов рублей по неофициальным и предварительным данным, сообщает портал kinobusiness.com.
В картине рассказывается о том, как Красная Шапочка узнает о судьбе своего отца и готовится спасти родной город от стаи волков.',
            'category_id' => 3,
        ],
        [
            'id' => 8,
            'title' => 'Драмеди, мистика, комедии: что смотреть в онлайн-кинотеатрах осенью',
            'text' => 'СОЧИ, 24 сен — РИА Новости, Анна Нехаева. Недавно в Сочи завершился фестиваль "Новый сезон". Там российские стриминги показали свои флагманские проекты — сериалы об отношениях, борьбе за справедливость, буллинге, токсичных партнерах, мистических школах и романтических мечтах. РИА Новости рассказывает, что ждет зрителей осенью в онлайн-кинотеатрах.
Качество, а не количество
"Мы видим спрос на качественный контент, будь то комедия или драма, — говорит продюсер Start Ирина Соснова. — А наша задача — выпускать событийные премьеры".
На "Новом сезоне" платформа представила проект с социальной повесткой — "Алиса не может ждать". Сериал о девушке, которая скоро ослепнет, а мать (Анна Михалкова) от нее это скрывает. Здесь — удивительный тандем главных героинь, детальные диалоги. Очень подробно показана будничная рутина подростка: от споров с родителями до непонимания сверстников, импульсивных поступков, баланса между ложью и правдой.',
            'category_id' => 3,
        ],
        [
            'id' => 9,
            'title' => 'Вы нас чем пугать вздумали: тенденции современного российского хоррора',
            'text' => 'МОСКВА, 25 сен — РИА Новости, Татьяна Рыжкова. В Москве завершается кинофестиваль хорроров "Капля". Режиссеры и организаторы рассказали РИА Новости, как себя чувствует жанр ужасов в России и как он меняется со временем.
Три составляющие кино
Российский хоррор делится на два течения. Во-первых — высокобюджетное кино, известное широкому кругу зрителей. И во-вторых — авторские экспериментальные фильмы, снятые за минимальные деньги. Эти картины показывают на фестивалях и интернет-платформах, круг поклонников у них узкий.',
            'category_id' => 3,
        ],
    ];

    /**
     * @return array[]
     */
    public function getNews(): array
    {
        return $this->news;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getArticleById($id): ?array
    {
        $collection = collect($this->getNews());
        $article = $collection->groupBy('id')->get($id);
        return $article ? $article->first() : null;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getByCategoryId(int $id): ?array
    {
        $collection = collect($this->getNews());
        $news = $collection->groupBy('category_id')->get($id);
        return $news ? $news->all() : null;
    }

    /**
     * @param string $slug
     * @param Category $category
     * @return array|null
     */
    public function getByCategorySlug(string $slug, Category $category): ?array
    {
        $id = $category->getIdBySlug($slug);
        return $this->getByCategoryId($id);
    }
}
