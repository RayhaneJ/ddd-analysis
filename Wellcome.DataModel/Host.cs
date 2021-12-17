using System.ComponentModel.DataAnnotations;

namespace Wellcome.DataModel
{
    public class Host
    {
        public int ID { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }
        public int AddressID { get; set; }
        public virtual Address Address { get; set; }
        public int ContactID { get; set; }
        public virtual Contact Contact { get; set; }
        public int ConfigurationID { get; set; }
        public virtual HostConfiguration Configuration { get; set; }
        public int TravelersID { get; set; }
        public virtual TravelersConfiguration Travelers { get; set; }
    }
}