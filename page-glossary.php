<?php
/*
 * Template Name: Glossary Page
 */
get_header(); ?>

<div class="resources-header">
    <div class="container">
        <h1 class="resources-header__title">Local SEO Glossary</h1>
        <p class="resources-header__subtitle">Definitions for every local SEO term you'll encounter — updated regularly.</p>
    </div>
</div>

<?php
// Build glossary terms array
$terms = array(
    'C' => array(
        array(
            'term' => 'Citation',
            'definition' => 'Any online mention of a business\'s name, address, and phone number (NAP). Citations help search engines verify a business\'s existence and location, and are a key local ranking factor.',
            'tag' => 'Ranking factor',
        ),
        array(
            'term' => 'Citation consistency',
            'definition' => 'The degree to which a business\'s NAP information is identical across all online directories and listings. Inconsistencies can confuse search engines and negatively impact local rankings.',
            'tag' => 'Best practice',
        ),
        array(
            'term' => 'Core Web Vitals',
            'definition' => 'A set of Google metrics measuring real-world user experience on a webpage: Largest Contentful Paint (LCP), Interaction to Next Paint (INP), and Cumulative Layout Shift (CLS). A Google ranking factor.',
            'tag' => 'Ranking factor',
        ),
    ),
    'G' => array(
        array(
            'term' => 'Google Business Profile',
            'definition' => 'A free Google tool that lets businesses manage how they appear in Google Search and Maps. Optimizing your GBP listing is the single most important action for local SEO.',
            'tag' => 'Core concept',
        ),
        array(
            'term' => 'Google Map Pack',
            'definition' => 'The block of three local business listings that appear at the top of Google Search results for local queries. Also called the Local Pack or 3-Pack. Appearing here drives significant traffic.',
            'tag' => 'Core concept',
        ),
    ),
    'L' => array(
        array(
            'term' => 'Local Pack',
            'definition' => 'See Google Map Pack. The set of local business results displayed prominently in Google Search, showing a map alongside three business listings.',
            'tag' => 'Core concept',
        ),
        array(
            'term' => 'Link building',
            'definition' => 'The process of acquiring hyperlinks from other websites to your own. Backlinks from authoritative, relevant sites signal trust and authority to search engines, improving rankings.',
            'tag' => 'Off-page SEO',
        ),
    ),
    'N' => array(
        array(
            'term' => 'NAP',
            'definition' => 'Stands for Name, Address, Phone number. Consistent NAP data across the web is a foundational element of local SEO and citation building. Even minor variations (St vs Street) can affect rankings.',
            'tag' => 'Core concept',
        ),
        array(
            'term' => 'NAP consistency',
            'definition' => 'The practice of ensuring a business\'s name, address, and phone number are identical everywhere they appear online — website, directories, social media, and third-party listings.',
            'tag' => 'Best practice',
        ),
    ),
    'O' => array(
        array(
            'term' => 'On-page SEO',
            'definition' => 'Optimization techniques applied directly to a webpage to improve its search visibility. Includes title tags, meta descriptions, heading structure, content quality, and internal linking.',
            'tag' => 'Core concept',
        ),
    ),
    'P' => array(
        array(
            'term' => 'Proximity',
            'definition' => 'One of the three primary local ranking factors (alongside relevance and prominence). Refers to how close a business is to the searcher\'s location at the time of the search query.',
            'tag' => 'Ranking factor',
        ),
    ),
    'R' => array(
        array(
            'term' => 'Review velocity',
            'definition' => 'The rate at which a business receives new reviews over time. A steady, consistent flow of new reviews signals to Google that a business is active and trusted by real customers.',
            'tag' => 'Ranking factor',
        ),
        array(
            'term' => 'Relevance',
            'definition' => 'One of the three primary local ranking factors. How well a local business listing matches what someone is searching for. Determined by categories, keywords, and business description.',
            'tag' => 'Ranking factor',
        ),
    ),
    'S' => array(
        array(
            'term' => 'Schema markup',
            'definition' => 'Structured data added to a webpage\'s HTML that helps search engines understand the content. For local businesses, LocalBusiness schema communicates address, hours, and contact details directly to Google.',
            'tag' => 'Technical SEO',
        ),
        array(
            'term' => 'SERP',
            'definition' => 'Search Engine Results Page. The page displayed by a search engine in response to a query. Local SERPs often include the Map Pack, organic results, ads, and featured snippets.',
            'tag' => 'Core concept',
        ),
    ),
);

// Get all letters that have terms
$active_letters = array_keys($terms);
$alphabet = range('A', 'Z');
?>

<!-- A–Z Index Bar -->
<div style="background: var(--warm-white); padding: 16px 0; border-bottom: 1px solid var(--border); position: sticky; top: 64px; z-index: 90;">
    <div class="container">
        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
            <?php foreach ( $alphabet as $letter ) :
                $has_terms = in_array( $letter, $active_letters );
            ?>
            <?php if ( $has_terms ) : ?>
            <a href="#letter-<?php echo esc_attr( $letter ); ?>"
               style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; font-size: 0.82rem; font-weight: 700; background: var(--yellow); color: var(--ink); border-radius: var(--radius); text-decoration: none; transition: opacity 0.18s ease;"
               onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                <?php echo esc_html( $letter ); ?>
            </a>
            <?php else : ?>
            <span style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; font-size: 0.82rem; font-weight: 600; color: var(--border); border: 1px solid var(--border); border-radius: var(--radius);">
                <?php echo esc_html( $letter ); ?>
            </span>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Glossary Terms -->
<div style="padding: 56px 0;">
    <div class="container--narrow">

        <?php foreach ( $terms as $letter => $letter_terms ) : ?>
        <div id="letter-<?php echo esc_attr( $letter ); ?>" style="margin-bottom: 48px; scroll-margin-top: 140px;">

            <div style="display: inline-block; font-size: 1.6rem; font-weight: 700; color: var(--ink); border-bottom: 3px solid var(--yellow); padding-bottom: 8px; margin-bottom: 24px; min-width: 36px;">
                <?php echo esc_html( $letter ); ?>
            </div>

            <?php foreach ( $letter_terms as $item ) : ?>
            <div style="border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px 24px; margin-bottom: 14px; transition: box-shadow 0.18s ease;"
                 onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.07)'" onmouseout="this.style.boxShadow='none'">
                <div style="font-size: 1rem; font-weight: 600; color: var(--ink); margin-bottom: 8px;">
                    <?php echo esc_html( $item['term'] ); ?>
                </div>
                <p style="font-size: 0.9rem; color: var(--mid-gray); line-height: 1.7; margin-bottom: 10px;">
                    <?php echo esc_html( $item['definition'] ); ?>
                </p>
                <?php if ( ! empty( $item['tag'] ) ) : ?>
                <span style="display: inline-block; background: var(--yellow-tint); color: var(--yellow-dark); font-size: 0.7rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; padding: 3px 10px; border-radius: 20px; border: 1px solid rgba(255,240,31,0.4);">
                    <?php echo esc_html( $item['tag'] ); ?>
                </span>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

        </div>
        <?php endforeach; ?>

        <div style="background: var(--ink); border-radius: var(--radius-lg); padding: 36px; text-align: center; margin-top: 48px;">
            <div style="font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--yellow); margin-bottom: 12px;">Missing a term?</div>
            <p style="color: rgba(255,255,255,0.6); font-size: 0.95rem; margin-bottom: 24px;">This glossary grows with every article. If you'd like a term added, get in touch.</p>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary">Suggest a term</a>
        </div>

    </div>
</div>

<?php get_footer(); ?>