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

        [HttpGet("presenters")]
        public async Task<List<HostPresenter>> GetHostsAsync() => await new HostsService(ctx).GetHostsPresentersAsync();

        [HttpPost("presenters/filter")]
        public async Task<List<HostPresenter>> GetHostsAsync([FromBody] TripPattern pattern) => await new HostsService(ctx).GetHostsPresentersAsync(pattern);

        [HttpGet("details/{uuid}")]
        public async Task<HostDetails> GetHostDetailsAsync(string uuid) => await new HostsService(ctx).GetHostDetailsAsync(uuid);

        [HttpPost("favorite/add")]
        public async Task AddHostFavorite(FavoriteRequest request) => await new HostsService(ctx).SetFavoriteHost(request);

        [HttpDelete("favorite/remove")]
        public async Task RemoveHostFavorite(FavoriteRequest request) => await new HostsService(ctx).RemoveFavoriteHost(request);

    }
}
