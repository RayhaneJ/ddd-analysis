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

        [HttpPost("presenters")]
        public List<HostPresenter> GetHosts() => new HostsService(ctx).GetHostsPresenters();

        [HttpPost("presenters/filter")]
        public List<HostPresenter> GetHosts([FromBody] TripPattern pattern) => new HostsService(ctx).GetHostsPresenters(pattern);

        [HttpPost("details/{id}")]
        public HostDetails GetHostPicture(int id) => new HostsService(ctx).GetHostDetails(id);

    }
}
