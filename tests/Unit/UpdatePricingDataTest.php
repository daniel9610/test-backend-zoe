<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\PricingData;
use Illuminate\Support\Facades\Queue;
use App\Jobs\UpdatePricingData;

class UpdatePricingDataTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testEndpointMock()
    {
        // pass if the endpoint contains the results key
        $data = new PricingData;
        $pricing_data = (array)json_decode($data->sampleData(1), false);
        $this->assertArrayHasKey('results', $pricing_data, "Array doesn't contains 'results' as key");
    }

    public function testProccess()
    {
        Queue::assertPushed(UpdatePricingData::class, 1);
        // $this->expectsJobs(UpdatePricingData::class);
        // $data = SecurityPrices::where('id', '1')->first();
    }
}
