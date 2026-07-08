<?php
$pageTitle = 'Frequently Asked Questions';
$pageDescription = 'Answers on quotations, air and ocean freight, documentation, payments, and cargo collection for Let Ship Africa Inc. customers.';
require __DIR__ . '/includes/header.php';

/**
 * Renders a Bootstrap accordion section.
 * @param array<int, array{0: string, 1: string}> $items [question, answer(html)]
 */
function faq_accordion(string $sectionId, array $items): void
{
    echo '<div class="accordion mb-5" id="' . e($sectionId) . '">';
    foreach ($items as $i => [$q, $a]) {
        $itemId = $sectionId . '-' . $i;
        $expanded = $i === 0 ? 'true' : 'false';
        $show = $i === 0 ? ' show' : '';
        $collapsed = $i === 0 ? '' : ' collapsed';
        echo '<div class="accordion-item">';
        echo '<h2 class="accordion-header"><button class="accordion-button' . $collapsed . '" type="button" data-bs-toggle="collapse" data-bs-target="#' . e($itemId) . '" aria-expanded="' . $expanded . '">' . e($q) . '</button></h2>';
        echo '<div id="' . e($itemId) . '" class="accordion-collapse collapse' . $show . '" data-bs-parent="#' . e($sectionId) . '">';
        echo '<div class="accordion-body">' . $a . '</div>';
        echo '</div></div>';
    }
    echo '</div>';
}
?>

<section class="lsa-page-header text-center">
    <div class="container">
        <p class="lsa-eyebrow mb-2">Support Center</p>
        <h1 class="fw-bold">Frequently Asked Questions</h1>
        <p class="lsa-text-on-dark mb-0">Informed customers make better decisions &mdash; find answers below, or contact our team directly.</p>
    </div>
</section>

<section class="lsa-section">
    <div class="container">

        <h2 class="fw-bold mb-4">Before You Contact Us</h2>
        <?php faq_accordion('faq-before', [
            ['I have never imported or exported before. Can Let Ship Africa help me?',
                '<p class="mb-0">Yes. Whether you are importing goods into Liberia or exporting products to international markets for the first time, our team will guide you through each stage of the process. We explain the requirements, documentation, shipping options, and next steps so you can make informed decisions with confidence.</p>'],
            ['I don\'t know whether to choose Air Freight or Sea Freight. Can you advise me?',
                '<p class="mb-0">Absolutely. The best shipping method depends on several factors, including the type of cargo, weight, volume, urgency, destination, and budget. After reviewing your shipment details, our logistics team will recommend the most suitable transportation option for your specific needs.</p>'],
            ['What information should I prepare before requesting a quotation?',
                '<p>Getting started is simple &mdash; your initial Shipping Inquiry just needs a brief description of what you\'d like to ship. Once our team reaches out, we\'ll send you our Shipment Intake Form to capture the full details, including:</p>
                <ul class="mb-2"><li>Description of the goods</li><li>Quantity</li><li>Estimated weight</li><li>Estimated dimensions (if available)</li><li>Country of origin</li><li>Destination country</li><li>Preferred shipping method (if known)</li><li>Any additional services required</li></ul>
                <p class="mb-0">Having this information ready in advance will help your intake form go faster, but it isn\'t required to start.</p>'],
            ['Can Let Ship Africa help me find suppliers?',
                '<p class="mb-0">Yes. If you have not yet identified a supplier, we offer sourcing and procurement support in selected international markets. We can assist with identifying potential suppliers, communicating with vendors, and coordinating purchasing activities.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">General Questions</h2>
        <?php faq_accordion('faq-general', [
            ['What services does Let Ship Africa Inc. provide?',
                '<p class="mb-0">We provide professional international logistics and trade facilitation services, including Air Freight, Ocean Freight, Cargo Consolidation, Import Services, Export Services, Sourcing &amp; Procurement, Trade Facilitation, and Logistics Consultation.</p>'],
            ['Who can use your services?',
                '<p class="mb-0">Our services are available to individuals, entrepreneurs, small and medium enterprises (SMEs), large businesses, government institutions, NGOs, educational institutions, and religious organizations. Whether you are shipping one package or coordinating commercial cargo, we are ready to assist.</p>'],
            ['Which countries do you currently serve?',
                '<p class="mb-0">We are actively building logistics partnerships connecting Liberia with international markets, including the United States, United Kingdom, China, Canada, Australia, and Europe. As our international network continues to grow, additional trade routes and destination services will become available.</p>'],
            ['What types of cargo do you handle?',
                '<p class="mb-0">We support a wide variety of commercial and personal shipments, subject to applicable laws and transportation regulations, including agricultural products, food products, consumer goods, household goods, clothing &amp; textiles, machinery &amp; equipment, auto parts, and commercial merchandise. Some products may require special permits, inspections, or certifications &mdash; our team will advise you after reviewing your shipment.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Pricing &amp; Quotations</h2>
        <?php faq_accordion('faq-pricing', [
            ['How much does shipping cost?',
                '<p class="mb-0">Every shipment is unique. Shipping costs depend on several factors, including type of goods, weight, dimensions, origin, destination, shipping method, and additional services required. To provide an accurate and transparent quotation, we first review your shipment details before preparing a customized quotation.</p>'],
            ['Why can\'t you give me a shipping price immediately?',
                '<p class="mb-0">Providing an accurate quotation requires understanding your shipment requirements. Quoting without sufficient information could result in incorrect pricing or unexpected costs later. Our goal is to provide clear, transparent, and accurate quotations based on your actual shipment.</p>'],
            ['Is requesting a quotation free?',
                '<p class="mb-0">Yes. Starting a shipping inquiry through our website or contacting our team does not obligate you to book a shipment. We encourage customers to reach out so they can make informed decisions before shipping.</p>'],
            ['How long is my quotation valid?',
                '<p class="mb-0">The validity period of your quotation will be stated in the quotation itself. Because freight rates, fuel costs, airline charges, shipping line charges, and other logistics costs may change over time, quotations may be subject to expiration and revision.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Air Freight</h2>
        <?php faq_accordion('faq-air', [
            ['When should I choose Air Freight?',
                '<p class="mb-0">Air Freight is generally recommended for urgent shipments, high-value goods, time-sensitive cargo, and smaller commercial shipments. Our team will help determine whether Air Freight is the most appropriate solution for your shipment.</p>'],
            ['How long does Air Freight usually take?',
                '<p class="mb-0">Transit times vary depending on the origin, destination, airline schedules, customs procedures, and other operational factors. After reviewing your shipment details, we will provide an estimated transit time before confirming your booking.</p>'],
            ['What types of goods are suitable for Air Freight?',
                '<p class="mb-0">Air Freight is commonly used for electronics, medical supplies, documents, samples, fashion products, and commercial goods. Certain dangerous goods or restricted items may require special handling or may not be accepted for air transportation.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Ocean Freight</h2>
        <?php faq_accordion('faq-ocean', [
            ['When should I choose Ocean Freight?',
                '<p class="mb-0">Ocean Freight is the most economical option for larger or heavier shipments that do not require urgent delivery &mdash; suitable for commercial cargo, household goods, machinery and equipment, building materials, agricultural products, and bulk shipments. If you are looking to reduce shipping costs and your shipment is not time-sensitive, Ocean Freight is often the best solution.</p>'],
            ['What is Cargo Consolidation?',
                '<p class="mb-0">Cargo Consolidation allows multiple customers to share space in one shipping container. Instead of paying for an entire container, customers pay only for the space their cargo occupies, making international shipping more affordable for individuals and small businesses.</p>'],
            ['Do I need enough cargo to fill a container?',
                '<p class="mb-0">No. Our cargo consolidation service allows customers with smaller shipments to ship without filling an entire container, helping reduce transportation costs while providing access to international shipping services.</p>'],
            ['How long does Ocean Freight usually take?',
                '<p class="mb-0">Transit time depends on country of origin, destination, shipping line schedules, port operations, and customs processing. Before confirming your booking, our team will provide an estimated transit time based on your shipment.</p>'],
            ['When is your next shipment?',
                '<p class="mb-0">Shipment schedules vary depending on destination, cargo readiness, and shipping line availability. Please contact our team for the latest shipment schedule for your destination.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Import Services</h2>
        <?php faq_accordion('faq-import', [
            ['Can Let Ship Africa help me import goods into Liberia?',
                '<p class="mb-0">Yes. We assist businesses and individuals importing products into Liberia by coordinating logistics, communicating with suppliers where required, and providing guidance throughout the shipping process.</p>'],
            ['I have never imported before. Can you guide me?',
                '<p class="mb-0">Absolutely. Our team will explain each step of the import process, including shipment planning, documentation requirements, transportation options, and customs coordination.</p>'],
            ['Can you communicate with my supplier?',
                '<p class="mb-0">Yes. Where appropriate, we can communicate with your supplier to coordinate shipment arrangements and help ensure the necessary logistics information is available before shipment.</p>'],
            ['Can you help me purchase products from overseas?',
                '<p class="mb-0">Yes. Our sourcing and procurement service assists customers who need help identifying suppliers, obtaining quotations, coordinating purchases, and arranging shipment.</p>'],
            ['Do you provide customs support?',
                '<p class="mb-0">We work with trusted customs professionals and logistics partners to support customs coordination where applicable. Specific customs services depend on the country involved and the scope of your shipment.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Export Services</h2>
        <?php faq_accordion('faq-export', [
            ['Can Let Ship Africa help me export products from Liberia?',
                '<p class="mb-0">Yes. We support businesses and individuals exporting goods from Liberia by coordinating logistics, reviewing documentation, and preparing shipments for international transportation.</p>'],
            ['What products can I export?',
                '<p class="mb-0">Export eligibility depends on the product and the regulations of both Liberia and the destination country. Our team will review your shipment and advise you on any documentation or regulatory requirements before shipment.</p>'],
            ['Can you help me understand export requirements?',
                '<p class="mb-0">Yes. If you are exporting for the first time, we will explain the documentation and shipping requirements relevant to your shipment. Requirements vary depending on the type of goods and destination country.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Documentation &amp; Compliance</h2>
        <?php faq_accordion('faq-docs', [
            ['What documents do I need before shipping?',
                '<p>Documentation requirements depend on your shipment. Common documents may include:</p>
                <ul class="mb-2"><li>Commercial Invoice</li><li>Packing List</li><li>Government-issued Identification</li><li>Export or Import Permits (where applicable)</li><li>Certificate of Origin</li><li>Health Certificate</li><li>Other supporting documents</li></ul>
                <p class="mb-0">Our logistics team will advise you after reviewing your shipment.</p>'],
            ['Why is documentation so important?',
                '<p class="mb-0">Proper documentation helps prevent shipment delays, customs issues, unnecessary costs, and regulatory problems. Our guiding principle is: "If it is not properly documented, we do not ship it."</p>'],
            ['What happens if I do not have all the required documents?',
                '<p class="mb-0">Please contact us before shipping. In many cases, our team can advise you on the documentation required and explain the next steps. However, shipments cannot proceed until all required documentation has been completed.</p>'],
            ['Will you review my documents before shipment?',
                '<p class="mb-0">Yes. As part of our customer service, we review available shipment documentation to identify missing information or potential issues before cargo is booked. This helps reduce delays and improves shipment preparation.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Payments</h2>
        <?php faq_accordion('faq-payments', [
            ['Do I pay before shipping or after shipping?',
                '<p>Our payment terms are designed to support efficient shipment planning while providing clarity for our customers.</p>
                <p><strong>Sea Freight:</strong> A 50% deposit is required to confirm your booking and begin shipment preparation. The remaining 50% balance must be paid before the vessel departs from the port of origin.</p>
                <p class="mb-0"><strong>Air Freight:</strong> Because air cargo bookings require immediate confirmation and airline processing, 100% payment is required before the shipment departs. Specific payment terms will always be confirmed in your quotation before your shipment is booked.</p>'],
            ['Why are Air Freight and Sea Freight payment terms different?',
                '<p class="mb-0">Air Freight generally requires faster booking confirmation and airline processing. Sea Freight shipments often involve longer planning timelines, allowing customers to pay a deposit initially and settle the remaining balance before departure.</p>'],
            ['What payment methods do you accept?',
                '<p class="mb-0">Available payment methods will be communicated during the quotation process. If you have questions regarding payment options, please contact our team before confirming your shipment.</p>'],
            ['Will I receive a receipt after making payment?',
                '<p class="mb-0">Yes. Every payment received by Let Ship Africa Inc. will be acknowledged with an official receipt for your records. We recommend keeping all payment receipts and shipment documents until your shipment has been successfully completed.</p>'],
        ]); ?>

        <h2 class="fw-bold mb-4">Cargo Collection &amp; Delivery</h2>
        <?php faq_accordion('faq-collection', [
            ['Can Let Ship Africa collect my cargo?',
                '<p class="mb-0">Yes. Depending on your location and the nature of your shipment, Let Ship Africa Inc. can arrange cargo collection through our trusted transportation partners. Collection services may be available anywhere in Liberia, subject to location, cargo type, scheduling, and transportation availability. Additional transportation charges may apply. Please contact our team to discuss your cargo collection requirements.</p>'],
            ['Do I have to bring my cargo to your office?',
                '<p class="mb-0">Not necessarily. Depending on your location and the agreed shipping arrangement, you may either deliver your cargo to our designated receiving location or request cargo collection through our transport partners. Our team will advise you on the most appropriate option.</p>'],
            ['Do you provide warehousing services?',
                '<p class="mb-0">Where required, we work with trusted warehouse partners to support cargo receiving, temporary storage, and shipment coordination. Warehouse services depend on the shipment, destination, and partner availability, so please contact our team to confirm whether warehousing support is available for your specific shipment.</p>'],
        ]); ?>

    </div>
</section>

<section class="lsa-hero text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Still Have Questions?</h2>
        <p class="lsa-text-on-dark mb-4">Our team is ready to walk you through your specific shipment, step by step.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="<?= e(SITE_URL) ?>/request-quote.php" class="btn btn-lsa-accent btn-lg fw-semibold">Start Your Shipping Inquiry</a>
            <a href="<?= e(SITE_URL) ?>/contact.php" class="btn btn-lsa-outline btn-lg fw-semibold">Contact Our Team</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
