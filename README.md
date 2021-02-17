<img src="./images/logo.sample.png" alt="Logo of the project" align="right">

# Nekons &middot; [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com) [![GitHub license](https://img.shields.io/badge/license-Apatche2.0-blue.svg?style=flat-square)](https://github.com/your/your-project/blob/master/LICENSE)

Типичные доки проекта, написанные вашим покорным слугой

## Документация [![PRs Welcome](https://img.shields.io/badge/version-beta0.1-red.svg?style=flat-square)](http://makeapullrequest.com)

Основная цель документации — обеспечение правильного написания фронта на проект, а правильно он пишется для практичности,
реиспользования и читаемости, а это в свою очередь очень важно, как для сайта, так и для здоровья того, кто писал данный
отрывок кода, так что убедительно прошу придерживаться всему описанному ниже.

Так же хочу сказать, что дизайн-система, которая используется на этом проекте несколько корява, но,
ближайшем будущем это будет исправлено

# Разработка

## Что, где и куда комитить?

В общем, на проекте есть три ветки: master (основная, туда идёт весь проверенный код), 
далее feature (туда идёт новая работающая фича, потом кидаешь пулл и делаешь мёрдж с master веткой, далее в feature ветке будет вестись отладка кода, а потом опять пулл и мёрдж)
и последняя ветка develop (туда идёт весь код находящийся в разработке, кароч разрабатывать надо тут).

Прототип бэка писать в release директории develop ветки

## Как писать CSS

> Для начала, думаю можно будет сказать что не нужно использовать НИКАКИХ align="center" и display: block;
поскольку данная комбинация является недопустимой и противоречит концепции приведённой выше

Внизу приведён типичный CSS, который мы используем:

```css
#sign-in .check .checkbox-text {
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
}
```

### Совет №1: Не повторяйтесь

В общем, что я име ввиду, по возможности нужно уменьшать количество повоторений в коде,
поскольку это позволит реиспользовать данный код, и его будет удобнее оптимизировать

Например, внизу описаны три стиля для кнопок:

```css
.primary-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    background: var(--blue);
    color: var(--white);
    border-radius: var(--radius-md);
}

.apply-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    background: var(--green);
    color: var(--white);
    border-radius: var(--radius-md);
}

.delete-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    background: var(--red);
    color: var(--white);
    border-radius: var(--radius-md);
}
```

Такой метод написания кода нежелателен, можно единожды написать общие правила в дополнительном классе,
и потом описать цвета в другие классы, как это сделано ниже:

```css 
.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    color: var(--white);
    border-radius: var(--radius-md);
} 

.primary-btn {
    background: var(--blue);
}

.apply-btn {
    background: var(--green);
}

.delete-btn {
    background: var(--red);
}
```

Как видно, это способствует отсутствию повторов, снижению количества строк, улучшению читаемости
и даже производительности кода

### Совет №2: Не используйте встроенные стили

Во-первых, используя встроенные стили ты будешь много перезаписывать их.

Во-вторых, это противоречит концепции разделения контента (HTML), дизайна (CSS) и логики (JS), хотя на этой странице данный принцип и нарушен, я написал маленькую JS функцию в HTML

И, в-третьих, это затрудняет поиск нужного тебе стиля в документе, по-этому прислушайся и не делай другим больно.

### Совет №3: Используйте сокращённые варианты записи свойств

Некоторые CSS-свойства, такие как padding, margin и border можно описывать гораздо проще,
применяя сокращенный вариант записи. Также это помогает уменьшить количество строк в правилах

При полном варианте записи CSS-класс выглядит так:

```css

.item {
    margin-left: 20px;
    margin-right: 10px;
    margin-top: 45px;
    margin-bottom: 5px;
    padding-left: 20px;
    padding-right: 10px;
    padding-top: 45px;
    padding-bottom: 5px;
    border-width: 2px;
    border-style: dashed;
    border-color: var(--blue);
}
```

При сокращении так:

```css

.item {
    margin: 45px 10px 5px 2px;
    padding: 45px 10px 5px 2px;
    border: 2px dashed var(--blue);
}
```

### Совет №4: При нужде пишите комментарии
Обычно, при чистом коде комментарии не нужны, но иногда случаются ситуации когда комменты необходимы,
например, если код требует дополнительных объяснений, но не надо с этим перебарщивать

### Совет №5:

В общем, говоря на прямую пиксели — это плохо, но я их всё равно использую,
стоит сказать, что для размера шрифта пиксели очень плохая единица измерения и является плохим тоном,
лучше используй rem и em, ведь они являются условными единицами измерения для браузера, и при адаптивной
вёрстке они очень сильно помогают, ведь браузер плохо понимает пиксели в размере шрифта. А так, используйте пиксели
и не парьтесь, но ждите, ведь настанет момент и всё придутся переписывать на em или rem

> Если что, 1rem = 16px, 1em = 24px, а что там по фракциям, это если что fr, я не знаю

И ещё, пишем всё на флексах, если не умеешь, то иди [сюда](https://webstacker.net/front-end/css/flexbox-samyj-polnyj-gajd-ili-kak-sverstat-sajt-i-ne-umeret/)

## Дизайн-система

> Дизайн-система — вещь очень важная на проекте, чти и почитай её, или сгниёшь в болоте говно кода

### Цвета

```css

:root {
    --primary-bg-color: #27282c;
    --sub-text-color: #83848f;
    --secondary-bg-color: #232526;
    --white: #fff;
    --blue: #0F6FFF;
    --form-text: #63717f;
    --form-bg: #2b303b;
    --dark-blue: #1E6BDD;
    --sub-icon-color: #6F7177;
    --red: #F77069;
     /*Цветов на самом деле больше, это пока-что все,
     что я смог ввести*/
}
```

Используйте эти переменные для обозначения цветов, пока-что так,
но скоро у нас появится файлик в figma со всеми объяснениями по
использованию цветов 

### Типографика

>Не создавайте велосипед заново, всё или же почти всё уже описано, используйте данные вам возможности грамотно


Тут я поясню за типографику

Для начала скажу о классах, для того чтобы сказать, что текст является заголовком,
пиши тэг ```h..``` и применяем к нему класс.

Объясню на заголовке первого уровня, пишем к тэгу класс ```.primary-heading```
и тебе только остаётся добавить к нему внешние отступы, такая же схема применима ко всем заголовкам

Для текста есть два класса ```.simple-text``` и ```.sub-text```.

```.simple-text``` используется для описания обычного текста,
а ```.sub-text``` для подтекста, в итоге, их тоже следует добавить к тегу
и прописать внешние отступы

Внизу описаны переменные для создания новых стилей:

```css
:root {
    --primary-heading: 2rem;
    /*Используется для приданию текста большого кегля*/
    --secondary-heading: 1.75rem;
    /*Используется для приданию текста не столь большого кегля*/
    --tertiary-heading: 1.4rem;
    /*Используется для приданию текста не столь большого кегля*/
    --simple-text: 1rem;
    /*Используется для обычного текста*/
    --sub-text: 0.8125rem;
    /*Используется для подтекста*/
    --inter: 'Inter', sans-serif;
    /*Переменная сидящая в body, указывающая на то, какую гарнитуру использовать*/
    --regular-weight: 400;
    /*Переменная для указывания жирности обычного текста*/
    --bold-weight: 700;
    /*Переменная для указывания жирности акцентного текста*/
    --black-weight: 900;
    /*Переменная для указывания жирности заголовку*/
}
```

### Отступы

>В основном все отступы заданны классами, используйте их, и только в ситуациях где классы не работают,
пишите переменные

Внизу перечисленны все классы отступов:

```css
.top-space-xxxxs {
    margin: var(--space-xxxxs) 0 0 0;
}
.top-space-xxxs {
    margin: var(--space-xxxs) 0 0 0;
}
.top-space-xxs {
    margin: var(--space-xxs) 0 0 0;
}
.top-space-xs {
    margin: var(--space-xs) 0 0 0;
}
.top-space-sm {
    margin: var(--space-sm) 0 0 0;
}
.top-space-md {
    margin: var(--space-md) 0 0 0;
}
.top-space-lg {
    margin: var(--space-lg) 0 0 0;
}
.top-space-xl {
    margin: var(--space-xl) 0 0 0;
}
.top-space-xxl {
    margin: var(--space-xxl) 0 0 0;
}
.top-space-xxxl {
    margin: var(--space-xxxl) 0 0 0;
}
.right-space-xxxxs {
    margin: 0 var(--space-xxxxs) 0 0;
}
.right-space-xxxs {
    margin: 0 var(--space-xxxs) 0 0;
}
.right-space-xxs {
    margin: 0 var(--space-xxs) 0 0;
}
.right-space-xs {
    margin: 0 var(--space-xs) 0 0;
}
.right-space-sm {
    margin: 0 var(--space-sm) 0 0;
}
.right-space-md {
    margin: 0 var(--space-md) 0 0;
}
.right-space-lg {
    margin: 0 var(--space-lg) 0 0;
}
.right-space-xl {
    margin: 0 var(--space-xl) 0 0;
}
.right-space-xxl {
    margin: 0 var(--space-xxl) 0 0;
}
.right-space-xxxl {
    margin: 0 var(--space-xxxl) 0 0;
}
.left-space-xxxxs {
    margin: 0 0 0 var(--space-xxxxs);
    text-decoration: none;
}
.left-space-xxxs {
    margin: 0 0 0 var(--space-xxxs);
    text-decoration: none;
}
.left-space-xxs {
    margin: 0 0 0 var(--space-xxs);
    text-decoration: none;
}
.left-space-xs {
    margin: 0 0 0 var(--space-xs) 0 0;
    text-decoration: none;
}
.left-space-sm {
    margin: 0 0 0 var(--space-sm);
    text-decoration: none;
}
.left-space-md {
    margin: 0 0 0 var(--space-md);
    text-decoration: none;
}
.left-space-lg {
    margin: 0 0 0 var(--space-lg);
    text-decoration: none;
}
.left-space-xl {
    margin: 0 0 0 var(--space-xl);
    text-decoration: none;
}
.left-space-xxl {
    margin: 0 0 0 var(--space-xxl);
    text-decoration: none;
    padding: 0;
}
.left-space-xxxl {
    margin: 0 0 0 var(--space-xxxl);
    text-decoration: none;
}
.bottom-space-xxxxs {
    margin: 0 0 var(--space-xxxxs) 0;
}
.bottom-space-xxxs {
    margin: 0 0 var(--space-xxxs) 0;
}
.bottom-space-xxs {
    margin: 0 0 var(--space-xxs) 0;
}
.bottom-space-xs {
    margin: 0 0 var(--space-xs) 0;
}
.bottom-space-sm {
    margin: 0 0 var(--space-sm) 0;
}
.bottom-space-md {
    margin: 0  0 var(--space-md) 0;
}
.bottom-space-lg {
    margin: 0 0 var(--space-lg)  0;
}
.bottom-space-xl {
    margin: 0 0 var(--space-xl) 0;
}
.bottom-space-xxl {
    margin: 0 0 var(--space-xxl) 0;
}
.bottom-space-xxxl {
    margin: 0 0 var(--space-xxxl) 0;
}

}
```

Внизу перечисленны все переменные отступов:

```css
:root {
    --space-unit: 1em;
    --space-xxxxs: calc(0.125 * var(--space-unit));
    --space-xxxs: calc(0.25 * var(--space-unit));
    --space-xxs: calc(0.375 * var(--space-unit));
    --space-xs: calc(0.5 * var(--space-unit));
    --space-sm: calc(0.75 * var(--space-unit));
    --space-md: calc(1.25 * var(--space-unit));
    --space-lg: calc(2 * var(--space-unit));
    --space-xl: calc(3.25 * var(--space-unit));
    --space-xxl: calc(5.25 * var(--space-unit));
    --space-xxxl: calc(8.5 * var(--space-unit));
    --space-xxxxl: calc(13.75 * var(--space-unit));
}
```

### Иконки 

#### О подготовке перед вставкой

Пока-что об этом парится не надо, прост скажите мне какая иконка нужна, и скоро она будет у вас на руках 

#### Как вставлять в HTML 
>ВАЖНО: вставляйте иконки спрайтами как в примере ниже, по другому не делайте

Так выглядит обычный инлайновый метод встраивания svg в html документ,
но у него есть свои нюансы: он плохо рендерится и занимает много места,
этот способ не может в адаптив, да и не про доступность он, а это противоречит тому,
что мы здесь делаем

```html
    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.8571 4.82143L14.8571 3.82143C14.7857 3.75 14.6786 3.71429 14.5357 3.71429C14.4286 3.71429 14.3571 3.75 14.2857 3.82143L5.07143 13.0357L1.67857 9.64286C1.60714 9.57143 1.53571 9.53571 1.42857 9.53571C1.28571 9.53571 1.17857 9.57143 1.10714 9.64286L0.107143 10.6429C0.0357143 10.7143 0 10.8214 0 10.9643C0 11.0714 0.0357143 11.1786 0.107143 11.2143L4.78571 15.9286C4.85714 16 4.96429 16 5.07143 16C5.21429 16 5.28571 16 5.35714 15.9286L15.8571 5.42857C15.9286 5.32143 15.9643 5.25 15.9643 5.10714C16 5 15.9286 4.89286 15.8571 4.82143ZM4.67857 9.07143C4.78571 9.14286 4.89286 9.14286 5 9.14286C5.14286 9.14286 5.21429 9.14286 5.28571 9.07143L12.6071 1.75C12.6786 1.64286 12.75 1.53571 12.75 1.42857C12.75 1.32143 12.6786 1.21429 12.6071 1.14286L11.6071 0.107143C11.5357 0.0357143 11.4286 0 11.2857 0C11.1786 0 11.0714 0.0357143 11 0.107143L5 6.17857L2.85714 4C2.78571 3.92857 2.67857 3.85714 2.57143 3.85714C2.46429 3.85714 2.35714 3.92857 2.25 4L1.25 5C1.17857 5.07143 1.14286 5.17857 1.14286 5.32143C1.14286 5.42857 1.17857 5.53571 1.25 5.60714L4.67857 9.07143Z" fill="black"/>
    </svg>
```

Вместо этого, лучше вставлять svg спрайтом как в примере ниже

```html
    <svg xmlns="http://www.w3.org/2000/svg">
        <symbol id="checked" viewBox="0 0 16 16">
            <path id="checked" d="M15.8571 4.82143L14.8571 3.82143C14.7857 3.75 14.6786 3.71429 14.5357 3.71429C14.4286 3.71429 14.3571 3.75 14.2857 3.82143L5.07143 13.0357L1.67857 9.64286C1.60714 9.57143 1.53571 9.53571 1.42857 9.53571C1.28571 9.53571 1.17857 9.57143 1.10714 9.64286L0.107143 10.6429C0.0357143 10.7143 0 10.8214 0 10.9643C0 11.0714 0.0357143 11.1786 0.107143 11.2143L4.78571 15.9286C4.85714 16 4.96429 16 5.07143 16C5.21429 16 5.28571 16 5.35714 15.9286L15.8571 5.42857C15.9286 5.32143 15.9643 5.25 15.9643 5.10714C16 5 15.9286 4.89286 15.8571 4.82143ZM4.67857 9.07143C4.78571 9.14286 4.89286 9.14286 5 9.14286C5.14286 9.14286 5.21429 9.14286 5.28571 9.07143L12.6071 1.75C12.6786 1.64286 12.75 1.53571 12.75 1.42857C12.75 1.32143 12.6786 1.21429 12.6071 1.14286L11.6071 0.107143C11.5357 0.0357143 11.4286 0 11.2857 0C11.1786 0 11.0714 0.0357143 11 0.107143L5 6.17857L2.85714 4C2.78571 3.92857 2.67857 3.85714 2.57143 3.85714C2.46429 3.85714 2.35714 3.92857 2.25 4L1.25 5C1.17857 5.07143 1.14286 5.17857 1.14286 5.32143C1.14286 5.42857 1.17857 5.53571 1.25 5.60714L4.67857 9.07143Z"/>
        </symbol>
    </svg>
```

Первым шагом я объясню, как нужно изменить код иконки в svg файле

1. Добавляем в код тэг ```<symbol>```, ему нужно будет добавить id
и вставить в него код тэга ```<path>```, которому нужно будет задать тот же id, что и тэгу ```symbol```
   
2. Убираем атрибуты ```fill```, ```width```, ```height``` и ```stroke``` в svg

3. Переносим атрибут ```viewBox``` в ```<symbol>```

На этом первый шаг завершён, теперь осталось лишь добавить наш svg в html код, внизу приведён пример вставленного кода

```html
    <svg aria-hidden="true">
        <use xlink:href="../img/icons/check-icon.svg#check"></use>
    </svg>  
```

Теперь объясню почему именно так:

1. Сначала пишем тэг ```<svg>``` и вставляем в него тэг ```<use>``` 

2. Задаём ```<svg>``` атрибут ```aria-hidden="true"```, это нужно для того, чтобы скрин ридер пропустил нашу иконку и не прочитывал её

3. Задаём ```<use>``` атрибут ```xlink:href="../путь_к_файлу"``` и в конце пути ставим id который писали в самом начале через селектор ```#```


Далее нам остаётся лишь задать размер нашему svg, это нужно делать через классы перечисленные ниже, в них же и описан цвет нашей svg

```css
/*Переменные*/
:root {
    --icon-xxxs: 8px;
    --icon-xxs: 12px;
    --icon-xs: 16px;
    --icon-sm: 20px;
    --icon-md: 32px;
    --icon-lg: 48px;
    --icon-xl: 64px;
    --icon-xxl: 96px;
    --icon-xxxl: 128px;
}

/*Классы*/
icon-xxxs {
    width: var(--icon-xxxs);
    height: var(--icon-xxxs);
    cursor: pointer;
}
.icon-xxs {
    width: var(--icon-xxs);
    height: var(--icon-xxs);
    fill: var(--white);
    cursor: pointer;
}
.icon-xs {
    width: var(--icon-xs);
    height: var(--icon-xs);
    fill: var(--white);
    cursor: pointer;
}
.icon-sm {
    width: var(--icon-sm);
    height: var(--icon-sm);
    fill: var(--sub-icon-color);
    cursor: pointer;
}
.icon-md {
    width: var(--icon-md);
    height: var(--icon-md);
    fill: var(--white);
    cursor: pointer;
}
.icon-lg {
    width: var(--icon-lg);
    height: var(--icon-lg);
}
.icon-xl {
    width: var(--icon-xl);
    height: var(--icon-xl);
}
.icon-xxl {
    width: var(--icon-xxl);
    height: var(--icon-xxl);
}
.icon-xxxl {
    width: var(--icon-xxxl);
    height: var(--icon-xxxl);
}
```

## Компоненты

### Кнопки 

В общем, есть несколько классов 