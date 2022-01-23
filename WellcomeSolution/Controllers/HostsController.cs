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

        [HttpPost]
        public async Task<HostPresenter> CreateHostsAsync([FromBody] HostRequest request) => await new HostsService(ctx).CreateHost(request);

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
