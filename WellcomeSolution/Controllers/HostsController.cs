using Microsoft.AspNetCore.Mvc;
using Wellcome.API;

namespace Wellcome.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class HostsController : ControllerBase
    {
        [HttpGet]
        public List<DataModel.Host> GetHosts() => new HostsService().GetHosts();

        [HttpGet("filter")]
        public List<DataModel.Host> GetHosts([FromBody] TripPattern pattern) => new HostsService().GetHosts(pattern);
    }
}
