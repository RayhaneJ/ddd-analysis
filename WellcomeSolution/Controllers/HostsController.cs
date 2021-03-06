using Microsoft.AspNetCore.Mvc;
using Wellcome.API;
using Wellcome.Database;

namespace Wellcome.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class HostsController : ControllerBase
    {
        private readonly WellcomeContext ctx;

        public HostsController(WellcomeContext context)
        {
            ctx = context;
        }

        [HttpGet("{email}/reservation/incoming")]
        public async Task<List<IncomingTripDto>> GetIncomingReservationsAsync(string email) 
            => await new HostsService(ctx).GetIncomingReservation(email);

        [HttpPut("{uuid}/reservation/accept")]
        public async Task<IActionResult> AcceptHostReservationsAsync(string uuid)
        {
            try
            {
                await new HostsService(ctx).AcceptHostsReservation(uuid);
                return Ok();
            }
            catch (Exception ex)
            {
                return StatusCode(500, ex.Message);
            }
        }

        [HttpDelete("{uuid}/reservation/delete")]
        public async Task<IActionResult> DeleteHostReservationsAsync(string uuid)
        {
            try
            {
                await new HostsService(ctx).DeleteHostsReservation(uuid);
                return Ok();
            }
            catch (Exception ex)
            {
                return StatusCode(500, ex.Message); 
            }
        }

        [HttpGet("{email}/reservation")]
        public async Task<List<HostReservationPresenterDto>> GetHostReservationsAsync(string email) => await new HostsService(ctx).GetHostsReservation(email);

        [HttpPost("reservation")]
        public async Task<HostReservationDto> SaveHostReservationAsync([FromBody] HostReservationDto request) => await new HostsService(ctx).SaveHostReservation(request);

        [HttpPost]
        public async Task<HostPresenter> CreateHostsAsync([FromBody] HostRequest request) => await new HostsService(ctx).CreateHost(request);

        [HttpGet("{email}/published")]
        public async Task<List<HostPresenter>> GetPublishedHostAsync(string email) => await new HostsService(ctx).GetPublishedHost(email);

        [HttpGet("presenters")]
        public async Task<List<HostPresenter>> GetHostsAsync() => await new HostsService(ctx).GetHostsPresentersAsync();

        [HttpPost("presenters/filter")]
        public async Task<List<HostPresenter>> GetHostsAsync([FromBody] TripPattern pattern) => await new HostsService(ctx).GetHostsPresentersAsync(pattern);

        [HttpGet("{uuid}/details")]
        public async Task<HostDetails> GetHostDetailsAsync(string uuid) => await new HostsService(ctx).GetHostDetailsAsync(uuid);

        [HttpPost("favorite")]
        public async Task AddHostFavorite([FromBody] FavoriteRequest request) => await new HostsService(ctx).SetFavoriteHost(request);

        [HttpDelete("favorite")]
        public async Task RemoveHostFavorite([FromBody] FavoriteRequest request) => await new HostsService(ctx).RemoveFavoriteHost(request);

        [HttpGet("{email}/favorites")]
        public async Task<List<HostPresenter>> GetFavorites(string email) => await new HostsService(ctx).GetFavorites(email);

        [HttpPost("image")]
        public async Task<IActionResult> UploadImage([FromForm] UploadForm form)
        {
            if(form.File.Length > 0)
            {
                var fileName = await new HostsService(ctx).UploadImage(form);
                return Ok(fileName);
            }
            return BadRequest("file length invalid.");
        }

    }
}
